<?php

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Route;

#admin
Route::prefix("admin")->group(function(){
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login/store',[LoginController::class,'store']);
    Route::middleware(['auth'])->group(function(){
        Route::get('/',[MainAdminController::class,'index'])->name('admin.home');      
        #MENU
        Route::prefix('menu')->group(function(){
            Route::get('/add',[MenuController::class,'create'])->name('menu.add');
            Route::post('/add',[MenuController::class,'store']);
            Route::get('/',[MenuController::class,'index'])->name('menu.list');
            Route::get('/edit/{id}',[MenuController::class,'edit'])->name('menu.edit');
            Route::post('/edit/{id}',[MenuController::class,'update'])->name('menu.update');
            Route::DELETE('/destroy',[MenuController::class,'destroy']);     
            
        });
        #PRODUCT
        Route::prefix('product')->group(function(){
            Route::get('/',[ProductController::class,'index'])->name('product.list');
            Route::get('/add',[ProductController::class,'create'])->name('product.add');
            Route::post('/add',[ProductController::class,'store'])->name('product.store');
            Route::get('/getProduct/{id}',[ProductController::class,'edit']);
            Route::post('/update',[ProductController::class,'update'])->name('product.update');
            Route::get('/delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
        });
         #PRODUCT
         Route::prefix('slider')->group(function(){
            Route::get('/',[SliderController::class,'index'])->name('slider.list');
            Route::get('/add',[SliderController::class,'create'])->name('slider.add');
            Route::post('/add',[SliderController::class,'store'])->name('slider.store');
            Route::get('/getSlider/{id}',[SliderController::class,'getSliderByID']);
            Route::post('/update',[SliderController::class,'update'])->name('slider.update');
            Route::get('/delete/{id}',[SliderController::class,'destroy'])->name('slider.delete');
        });
         #CART
         Route::prefix('cart')->group(function(){
             Route::get('/',[App\Http\Controllers\Admin\CartController::class,'index'])->name('cart.list');
             Route::get('/view/{customer}',[App\Http\Controllers\Admin\CartController::class,'show'])->name('cart.show');
         });
        #get sub menu
        Route::get('get-sub',[MenuController::class,'getSub'])->name('menu.getsub');
        #Upload
        Route::post('upload/services',[UploadController::class,'store']);
        Route::post('upload/services-slider',[UploadController::class,'storeSlider']);
        Route::post('upload/services-menu',[UploadController::class,'storeMenu']);
        Route::post('days-order',[StatisticController::class,'daysorder']);
        Route::post('filter-by-date',[StatisticController::class,'filterByDate']);
        Route::post('dashboard-filter',[StatisticController::class,'filterByOption']);
    });
});
#client

    Route::get('/',[MainController::class,'index'])->name('home')->middleware('traffic');
    Route::post('/services/load-product',[MainController::class,'loadProduct'])->name('loadProduct');
    #menu
    Route::prefix('/danh-muc')->group(function(){
        Route::get('{id}-{slug}.html',[App\Http\Controllers\MenuController::class,'index']);
    });
    #Product
    Route::prefix('/san-pham')->group(function(){
        Route::get('{id}-{slug}.html',[App\Http\Controllers\ProductController::class,'index']);
    });
    Route::post('/add-cart',[CartController::class,'index']);
    Route::get('/carts',[CartController::class,'show']);
    Route::post('/carts',[CartController::class,'addCart']);
    Route::post('/update-cart',[CartController::class,'update']);
    Route::get('/carts/delete/{id}',[CartController::class,'remove']);
