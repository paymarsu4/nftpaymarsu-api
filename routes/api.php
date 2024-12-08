<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\PaymentCategoryController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\PaidNftController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["middleware" => ["auth:sanctum"]], function (){
    Route::group(['prefix'=>'users', 'as'=>'users.'], function(){
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
        Route::post('update', [UserController::class, 'update'])->name('update');
        Route::get('/students/{college_id}', [UserController::class, 'students'])->name('students');
    });

    Route::group(['prefix'=>'colleges', 'as'=>'colleges.'], function(){
        Route::get('/', [CollegeController::class, 'index'])->name('index');
        Route::get('/getcolleges', [CollegeController::class, 'getColleges'])->name('getcolleges');
    });

    Route::group(['prefix'=>'paymentcategories', 'as'=>'paymentcategories.'], function(){
        Route::get('/', [PaymentCategoryController::class, 'index'])->name('index');
        Route::get('/getforopt', [PaymentCategoryController::class, 'getForOpt'])->name('getforopt');
        Route::post('store', [PaymentCategoryController::class, 'store'])->name('store');
        Route::get('/show/{id}', [PaymentCategoryController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [PaymentCategoryController::class, 'edit'])->name('edit');
        Route::post('update', [PaymentCategoryController::class, 'update'])->name('update');
    });

    Route::group(['prefix'=>'nfts', 'as'=>'nfts.'], function(){
        Route::get('/', [NftController::class, 'index'])->name('index');
        Route::post('store', [NftController::class, 'store'])->name('store');
        Route::get('/show/{id}', [NftController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [NftController::class, 'edit'])->name('edit');
        Route::post('update', [NftController::class, 'update'])->name('update');
    });

    Route::group(['prefix'=>'paidnfts', 'as'=>'paidnfts.'], function(){
        Route::get('/', [PaidNftController::class, 'index'])->name('index');
        Route::post('store', [PaidNftController::class, 'store'])->name('store');
        Route::get('/show/{id}', [PaidNftController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [PaidNftController::class, 'edit'])->name('edit');
        Route::post('update', [PaidNftController::class, 'update'])->name('update');
    });
});

Route::get('/getcolleges', [CollegeController::class, 'getColleges'])
                ->middleware('guest')
                ->name('getcolleges');