<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Test;
use App\Models\TestToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TestController extends Controller
{
    private function getRemainingMinutes($testToken)
    {
        if (now()->gt($testToken->expires_at)) {
            return 0;
        }

        return now()->diffInMinutes($testToken->expires_at, false);
    }

    public function create(Request $request)
    {
        // Mark any existing active tests as inactive for this user
        TestToken::where('user_id', Auth::id())
            ->whereIn('status', ['not started', 'in progress'])
            ->update(['status' => 'abandoned']);

        // Generate a new random test of questions from the database
        $questionAmount = env('TEST_QUESTION_AMOUNT', 5);
        $questions = Question::where('is_deleted', 0)
            ->inRandomOrder()
            ->take($questionAmount)
            ->get();

        // Check if enough questions are available
        if ($questions->count() < $questionAmount) {
            return back()->with('error', 'Not enough questions available to generate a test.');
        }

        // Generate unique token and create test token record with expiration
        $token = Str::uuid();
        $testToken = TestToken::create([
            'user_id' => Auth::id(),
            'token' => $token,
            'expires_at' => now()->addMinutes((int) env('TEST_TIME_LIMIT_MINUTES', 60)),
            'status' => 'not started',
        ]);

        // Store the specific questions for this test
        foreach ($questions as $question) {
            Test::create([
                'test_token_id' => $testToken->id,
                'question_id' => $question->id,
            ]);
        }

        // Redirect the user to a page with a unique token for those test questions
        return redirect("/test/take/{$token}");
    }

    public function take($token)
    {
        // Validate token and check if test is accessible
        $testToken = TestToken::where('token', $token)
            ->where('user_id', Auth::id())
            ->first();

        if (! $testToken) {
            return redirect('/test')->with('error', 'Invalid test token.');
        }

        // Check if test has expired
        if (now()->gt($testToken->expires_at)) {
            $testToken->update([
                'status' => 'timed out',
                'score' => '0',
                'submitted_at' => now(),
            ]);

            return view('main.take-test')->with('showModal', [
                'title' => 'Time Up!',
                'message' => 'Your test time has expired.',
            ]);
        }

        // Check if test is still accessible (not completed, failed, or timed out)
        if (in_array($testToken->status, ['submitted', 'timed out', 'abandoned'])) {
            return redirect('/test')->with('error', 'That test is no longer accessible.');
        }

        // Mark test as in progress if it was 'not started'
        if ($testToken->status === 'not started') {
            $testToken->update(['status' => 'in progress']);
        }

        // Get the specific questions for this test
        $questions = Question::whereIn(
            'id',
            Test::where('test_token_id', $testToken->id)->pluck('question_id')
        )->with('answers')->get();

        // Calculate remaining time in minutes
        $remainingMinutes = $this->getRemainingMinutes($testToken);

        return view('main.take-test', compact('testToken', 'questions', 'remainingMinutes'));
    }

    public function submit(Request $request, $token)
    {
        // Validate token and ownership
        $testToken = TestToken::where('token', $token)
            ->where('user_id', Auth::id())
            ->first();

        if (! $testToken) {
            return redirect('/test')->with('error', 'Invalid test token.');
        }

        // Check if test has expired before saving
        if (now()->gt($testToken->expires_at)) {
            $testToken->update([
                'status' => 'timed out',
                'score' => '0',
                'submitted_at' => now(),
            ]);

            return view('main.take-test')->with('showModal', [
                'title' => 'Time Up!',
                'message' => 'Your test time has expired.',
            ]);
        }

        // Check if test is still accessible (not completed, failed, or timed out)
        if (in_array($testToken->status, ['submitted', 'timed out', 'abandoned'])) {
            return redirect('/test')->with('error', 'That test is no longer accessible.');
        }

        // Save user answers and calculate score
        $testQuestions = Test::where('test_token_id', $testToken->id)->get();
        $correctAnswers = 0;
        $totalQuestions = $testQuestions->count();

        foreach ($testQuestions as $test) {
            $selectedAnswerId = $request->input("question_{$test->question_id}");
            if ($selectedAnswerId) {
                $test->update([
                    'answer_id' => $selectedAnswerId,
                ]);

                // Check if answer is correct
                $answer = \App\Models\Answer::find($selectedAnswerId);
                if ($answer && $answer->is_correct) {
                    $correctAnswers++;
                }
            }
        }

        // Calculate score percentage
        $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;

        // Mark test as submitted with score
        $testToken->update([
            'status' => 'submitted',
            'score' => $score,
            'submitted_at' => now(),
        ]);

        return view('main.take-test')->with('showModal', [
            'title' => 'Test Submitted!',
            'message' => "You have successfully submitted your test. Your score: {$score}%",
        ]);
    }

    public function get_remaining_time($token)
    {
        $testToken = TestToken::where('token', $token)
            ->where('user_id', Auth::id())
            ->first();

        if (! $testToken) {
            return response()->json(['error' => 'Invalid token'], 404);
        }

        $remainingMinutes = $this->getRemainingMinutes($testToken);
        // a test is expired if the remaining time is up or if the test status is not 'in progress'
        $expired = $remainingMinutes <= 0 || $testToken->status !== 'in progress';

        return response()->json([
            'remainingMinutes' => $remainingMinutes,
            'expired' => $expired,
        ]);
    }
}
