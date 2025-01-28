<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get(Request $request)
    {
        $request->validate(
            [
                'num_tests_per_page' => 'numeric',
            ]
        );

        $data = [
            'num_tests_per_page' => $request['num_tests_per_page'],
        ];

        if ($request['sort']) {
            $data['sort'] = $request['sort'];
        }

        return view('main.test')->with($data);
    }
}
