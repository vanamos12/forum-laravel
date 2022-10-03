<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Categries
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category:slug}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category:slug}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category:slug}', [CategoryController::class, 'delete'])->name('delete');
    });
});