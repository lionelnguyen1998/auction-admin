<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//home
Route::resource('auctions', App\Http\Controllers\AuctionController::class);

//admin login
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

//admin
///Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        //User
        Route::prefix('users')->group(function () {
            Route::get('list', [UserController::class, 'index']);
            Route::get('view/{userId}', [UserController::class, 'show']);
            Route::get('destroy/{userId}', [UserController::class, 'destroy']);
        });

        //Auction
        Route::prefix('auctions')->group(function () {
            Route::get('list', [AuctionController::class, 'index']);
            Route::get('view/{auctionId}', [AuctionController::class, 'show']);
            Route::post('wait/{auctionId}', [AuctionController::class, 'store']);
            Route::get('destroy/{auctionId}', [AuctionController::class, 'destroy']);
        });

        //Comments
        Route::prefix('comments')->group(function () {
            Route::get('destroy/{commentId}', [CommentController::class, 'destroy']);
        });
    });
//});

//client
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);