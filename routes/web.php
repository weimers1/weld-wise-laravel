<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\TestController;
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

Route::get('/user/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('/user/login', [SessionController::class, 'create']);

Route::post('/user/create', [SessionController::class, 'create'], ['loggingIn' => false]);

Route::get('/user/test', [TestController::class, 'create']);

Route::fallback(function () {
    return view('errors.404');
});
