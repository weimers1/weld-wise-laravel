<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\TestToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TestController extends Controller
{
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

        // Generate unique token
        $token = Str::uuid();

        // Create test token record
        $testToken = TestToken::create([
            'user_id' => Auth::id(),
            'token' => $token,
            'status' => 'not started'
        ]);

        // Begin the timer with a callback function onTestTimeLimitReached
        // Note: This will be handled by frontend JavaScript timer and backend validation
        
        // Redirect the user to a page with a unique token for those test questions
        return redirect("/test/take/{$token}");
    }

    public function take($token)
    {
        // Validate token and check if test is accessible
        $testToken = TestToken::where('token', $token)
            ->where('user_id', Auth::id())
            ->first();

        if (!$testToken) {
            return redirect('/test')->with('error', 'Invalid test token.');
        }

        // Check if test is still accessible (not completed, failed, or timed out)
        if (in_array($testToken->status, ['submitted', 'timed out', 'abandoned'])) {
            return redirect('/test')->with('error', 'This test is no longer accessible.');
        }

        // Mark test as in progress if it was 'not started'
        if ($testToken->status === 'not started') {
            $testToken->update(['status' => 'in progress']);
        }

        // Get questions for this test (from the original generateTest logic)
        $questionAmount = env('TEST_QUESTION_AMOUNT', 5);
        $questions = Question::where('is_deleted', 0)
            ->with('answers')
            ->inRandomOrder()
            ->take($questionAmount)
            ->get();

        $timeLimit = env('TEST_TIME_LIMIT_MINUTES', 60);

        return view('main.take-test', compact('testToken', 'questions', 'timeLimit'));
    }

    public function timeout($token)
    {
        // This method handles timeout from frontend JavaScript
        $this->onTestTimeLimitReached($token);
        return response()->json(['status' => 'timeout']);
    }

    public function onTestTimeLimitReached($token)
    {
        // Check the status of the test for the given token
        $testToken = TestToken::where('token', $token)->first();
        
        if (!$testToken) {
            return;
        }

        // If the test does not have a status of 'submitted'
        if ($testToken->status !== 'submitted') {
            // Mark the test score as 0 and status of 'timed out'
            $testToken->update([
                'status' => 'timed out',
                'score' => '0',
                'submitted_at' => now()
            ]);

            // Increment the attempt counter
            // Note: This would require an attempt_counts table relationship
            // For now, we'll leave this as a placeholder for future implementation
        }
    }
}
