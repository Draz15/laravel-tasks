<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WatchListController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return '<h1>home</h1>';
});




Route::get('/watchlist', [WatchListController::class, 'index']);
Route::post('/watchlist', [WatchListController::class, 'store']);
Route::get('/watchlist/check', [WatchListController::class, 'check']);
Route::delete('/watchlist/{id}', [WatchListController::class, 'destroy']);
Route::delete('/watchlist', [WatchListController::class, 'destroyByMovie']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(["middleware" => "CheckAdmin"], function () {
    Route::get('/users', [UserController::class, 'index']);

    Route::get("movies", [MovieController::class, "index"]);

    Route::get("movies/create", [MovieController::class, "create"]);

    Route::post("movies", [MovieController::class, "store"]);

    Route::get("movies/{id}", [MovieController::class, "show"]);

    Route::get("movies/{id}/edit", [MovieController::class, "edit"]);

    Route::put("movies/{id}", [MovieController::class, "update"]);

    Route::delete("movies/{id}", [MovieController::class, "destroy"]);
});


    
Route::get('/', [ChatbotController::class, 'index'])->name('welcome');

Route::post('/chat', [ChatbotController::class, 'chat'])->name('chat');

// Route::resource("movies",MovieController::class);
