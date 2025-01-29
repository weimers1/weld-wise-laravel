<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    function add_to_cart(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/user/login');
        }

        dd($request);
    }

    function get()
    {
        return view('main.test');
    }
}
