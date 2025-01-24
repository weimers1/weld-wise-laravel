<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.index');
});

Route::get('/faq', function () {
    return view('main.faq');
});

Route::get('/user/authenticate', [SessionController::class, 'authenticate']);

Route::get('/user/login', function () {
    return view('auth.index');
});

Route::get('/user/logout', [SessionController::class, 'destroy']);

Route::post('/user/login', [SessionController::class, 'create']);

Route::post('/user/create', [SessionController::class, 'create'], ['loggingIn' => false]);

Route::get('/user/authenticate', [SessionController::class, 'authenticate']);
