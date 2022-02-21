<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\BrandController;

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
            Route::get('wait', [AuctionController::class, 'list']);
            Route::get('viewAuctionWait/{auctionId}', [AuctionController::class, 'viewAuctionWait']);
            Route::get('accept/{auctionStatusId}', [AuctionController::class, 'accept']);
            Route::get('destroy/{auctionId}', [AuctionController::class, 'destroy']);
            Route::post('reject', [AuctionController::class, 'reject'])->name('auctionreject');
        });

        //Cartegory
        Route::prefix('categories')->group(function () {
            Route::get('list', [CategoryController::class, 'index']);
            Route::get('create', [CategoryController::class, 'create']);
            Route::post('store', [CategoryController::class, 'store'])->name('insertcategories');
            Route::get('view/{categoryId}', [CategoryController::class, 'view']);
            Route::get('edit/{categoryId}', [CategoryController::class, 'edit']);
            Route::post('update', [CategoryController::class, 'update'])->name('updatecategory');
            Route::get('destroy/{categoryId}', [CategoryController::class, 'destroy']);
        });

        //Item
        Route::prefix('items')->group(function () {
            Route::get('list/{categoryId}', [ItemController::class, 'index']);
        });

        //Brand
        Route::prefix('brands')->group(function () {
            Route::get('list', [BrandController::class, 'index']);
            Route::get('create', [BrandController::class, 'create']);
            Route::post('store', [BrandController::class, 'store'])->name('insertbrand');
            Route::get('view/{brandId}', [BrandController::class, 'view']);
            Route::get('edit/{brandId}', [BrandController::class, 'edit']);
            Route::post('update', [BrandController::class, 'update'])->name('updatebrand');
            Route::get('destroy/{brandId}', [BrandController::class, 'destroy']);
        });

        //Series
        Route::prefix('series')->group(function () {
            Route::get('list', [SeriesController::class, 'index']);
            Route::get('create', [SeriesController::class, 'create']);
            Route::post('store', [SeriesController::class, 'store'])->name('insertseries');
            Route::get('view/{seriesId}', [SeriesController::class, 'view']);
            Route::get('edit/{seriesId}', [SeriesController::class, 'edit']);
            Route::post('update', [SeriesController::class, 'update'])->name('updateseries');
            Route::get('destroy/{seriesId}', [SeriesController::class, 'destroy']);
        });

        //Comments
        Route::prefix('comments')->group(function () {
            Route::get('destroy/{commentId}', [CommentController::class, 'destroy']);
        });
    });
//});

//client
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);