<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UrlsController;
use App\Http\Controllers\SubscriptionsController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect('login');
});



Route::middleware([ 'auth'])->group(function () {
    Route::get('/dashboard',[PagesController::class,'dashboard'] )->name('dashboard'); 
    Route::resource('/urls',UrlsController::class)->except(['index','create','show']); 
    Route::resource('/subscriptions',SubscriptionsController::class)->only(['store']); 
});

Route::get('/{short_code}', [PagesController::class,'shortCodeRedirection'] );

require __DIR__.'/auth.php';
