<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'description' => '',
        'explanation' => '',
    ];

    protected $primaryKey = 'id';

    protected $fillable = ['description', 'explanation'];

    public function generateTest($amount)
    {
        // get random questions
        $questions = Question::inRandomOrder()->take($amount)->get();

        // Check if enough questions are available
        $total_questions_count = Question::count();
        if ($total_questions_count < $amount) {
            return response()->json(['error' => 'Not enough questions available to generate a test of this size.'], 400);
        }

        // generate token
        $test_token_string = uuid_create();

        // store in test tokens and tests tables
        $test_token_id = DB::table('test_tokens')->insertGetId([
            'user_id' => Auth::user()->id,
            'token' => $test_token_string,
            'status' => 'not started',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $test_records = [];
        foreach ($questions as $question) {
            $test_records[] = [
                'test_token_id' => $test_token_id,
                'question_id' => $question->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // insert all collected records into the 'tests' table in a single batch
        if (!empty($test_records)) {
            DB::table('tests')->insert($test_records);
        }

        // return token
        return $test_token_string;
    }
}
