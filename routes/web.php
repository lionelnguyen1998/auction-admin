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
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\BidController;

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

//admin login
Route::middleware(['locale'])->group(function() {
    Route::get('change-language/{language}', [MainController::class, 'changeLanguage'])->name('user.change-language');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('login/store', [LoginController::class, 'store'])->name('storeAdmin');

    //admin
    Route::middleware(['auth'])->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index'])->name('admin');


        //User
        Route::prefix('users')->group(function () {
            Route::get('list', [UserController::class, 'index'])->name('listUser');
            Route::get('view/{userId}', [UserController::class, 'show'])->name('viewUser');
            Route::get('destroy/{userId}', [UserController::class, 'destroy'])->name('deleteUser');
            Route::get('info', [UserController::class, 'info'])->name('adminInfo');
            Route::get('create', [UserController::class, 'create'])->name('createUser');
            Route::post('store', [UserController::class, 'store'])->name('storeUser');
            Route::get('edit/{userId}', [UserController::class, 'edit'])->name('editUser');
            Route::put('update', [UserController::class, 'update'])->name('updateUser');
        });

        //Auction
        Route::prefix('auctions')->group(function () {
            Route::get('list', [AuctionController::class, 'index'])->name('listAuctions');
            Route::get('view/{auctionId}', [AuctionController::class, 'show'])->name('viewAuction');
            Route::get('wait', [AuctionController::class, 'list'])->name('listAuctionsIsWait');
            Route::get('viewAuctionWait/{auctionId}', [AuctionController::class, 'viewAuctionWait'])->name('viewAuctionIsWait');
            Route::get('accept/{auctionId}', [AuctionController::class, 'accept'])->name('acceptAuction');
            Route::get('destroy/{auctionId}', [AuctionController::class, 'destroy'])->name('deleteAuction');
            Route::post('reject', [AuctionController::class, 'reject'])->name('auctionreject');
        });

        //Cartegory
        Route::prefix('categories')->group(function () {
            Route::get('list', [CategoryController::class, 'index'])->name('listCategories');
            Route::get('create', [CategoryController::class, 'create'])->name('createCategory');
            Route::post('store', [CategoryController::class, 'store'])->name('insertcategories');
            Route::get('view/{categoryId}', [CategoryController::class, 'view'])->name('viewCategory');
            Route::get('edit/{categoryId}', [CategoryController::class, 'edit'])->name('editCategory');
            Route::post('update', [CategoryController::class, 'update'])->name('updatecategory');
            Route::get('destroy/{categoryId}', [CategoryController::class, 'destroy'])->name('deleteCategory');
        });

        //Upload
        Route::post('/upload/services', [UploadController::class, 'store']);


        //Item
        Route::prefix('items')->group(function () {
            Route::get('list', [ItemController::class, 'index'])->name('listItems');
            Route::get('view/{itemId}', [ItemController::class, 'show'])->name('viewItem');
        });

        //Brand
        Route::prefix('brands')->group(function () {
            Route::get('list', [BrandController::class, 'index'])->name('listBrands');
            Route::get('create', [BrandController::class, 'create'])->name('createBrand');
            Route::post('store', [BrandController::class, 'store'])->name('insertbrand');
            Route::get('view/{brandId}', [BrandController::class, 'view'])->name('viewBrand');
            Route::get('edit/{brandId}', [BrandController::class, 'edit'])->name('editBrand');
            Route::post('update', [BrandController::class, 'update'])->name('updatebrand');
            Route::get('destroy/{brandId}', [BrandController::class, 'destroy'])->name('deleteBrand');
        });

        //Comments
        Route::prefix('comments')->group(function () {
            Route::get('destroy/{commentId}', [CommentController::class, 'destroy'])->name('deleteComment');
        });

        //News
        Route::prefix('news')->group(function () {
            Route::get('list', [NewController::class, 'index'])->name('listNews');
            Route::get('create', [NewController::class, 'create'])->name('createNew');
            Route::post('store', [NewController::class, 'store'])->name('insertNew');
            Route::get('edit/{newId}', [NewController::class, 'edit'])->name('editNew');
            Route::put('update/{newId}', [NewController::class, 'update'])->name('updateNew');
            Route::get('delete/{newId}', [NewController::class, 'delete'])->name('deleteNew');
        });

        //Slider
        Route::prefix('sliders')->group(function () {
            Route::get('list', [SliderController::class, 'index'])->name('listSliders');
            Route::get('create', [SliderController::class, 'create'])->name('createSlider');
            Route::post('store', [SliderController::class, 'store'])->name('insertSlider');
            Route::get('edit/{sliderId}', [SliderController::class, 'edit'])->name('editSlider');
            Route::put('update', [SliderController::class, 'update'])->name('updateSlider');
            Route::get('delete/{sliderId}', [SliderController::class, 'delete'])->name('deleteSlider');
        });

        //Bid
        Route::prefix('bids')->group(function () {
            Route::get('destroy/{bidId}', [BidController::class, 'destroy'])->name('deleteBid');
        });
    });
});
