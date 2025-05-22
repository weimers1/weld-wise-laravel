<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(Request $request)
    {
        dd($request);
        // generate a new random test of questions from the database

        // save those questions into the tests table for that user

        // generate a unique token with a status of 'started' for that batch of questions in the test_tokens table

        // begin the timer with a callback function onTestTimeLimitReached

        // redirect the user to a page with a unique token for those test questions where visiting the page 
    }

    public function onTestTimeLimitReached($token)
    {
        // check the status of the test for the given token

        // if the test does not have a status of 'submitted'

            // mark the test score as 0 and status of 'timed out'

            // increment the attempt counter

    }
}
