<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.index');
});

Route::get('/faq', function () {
    return view('main.faq');
});

Route::get('/test', function () {
    return view('main.test');
})->middleware('auth');

Route::get('/user/authenticate', [SessionController::class, 'authenticate']);

Route::get('/user/login', [SessionController::class, 'get']);

Route::get('/user/logout', [SessionController::class, 'destroy']);

Route::post('/user/login', [SessionController::class, 'create']);

Route::post('/user/create', [SessionController::class, 'create'], ['loggingIn' => false]);

Route::fallback(function () {
    return view('errors.404');
});
