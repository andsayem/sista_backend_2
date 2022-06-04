<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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
// Remove route cache
Route::get('/clear', function() {
    $exitCode = Artisan::call('route:cache');
    return 'All routes cache has just been removed';
});
//Remove config cache
Route::get('/clear-config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache has just been removed';
}); 
// Remove application cache
Route::get('/clear-app-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache has just been removed';
});
// Remove view cache
Route::get('/clear-view-cache', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache has jut been removed';
});
// Route::get('/', function () {
//     return view('index');
// });
//Route::get('/', [App\Http\Controllers\admin\DashbordController::class, 'index']);
 
//Route::get('/', 'App\Http\Controllers\admin\DashbordController@index');
 
Auth::routes();
// Route::group([
//     'prefix' => 'admin'
// ], function () {
//     Route::get('home', [App\Http\Controllers\admin\DashbordController::class, 'index']);
//     Route::get('cagegory', [App\Http\Controllers\admin\CategoryController::class, 'index'])->name('cagegory');
// });

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get('dashboard', [App\Http\Controllers\admin\DashbordController::class, 'index'])->name('dashboard');
    Route::get('cagegory', [App\Http\Controllers\admin\CategoryController::class, 'index'])->name('post_category'); 
    Route::get('product/list', [App\Http\Controllers\admin\ProductController::class, 'index'])->name('product_list'); 
    Route::get('event/list', [App\Http\Controllers\admin\EventController::class, 'index'])->name('event_list'); 
    Route::get('journal/list', [App\Http\Controllers\admin\JournalController::class, 'index'])->name('journal_list'); 
    Route::get('posts', [App\Http\Controllers\admin\PostController::class, 'index'])->name('posts'); 
    Route::get('users', [App\Http\Controllers\admin\UserController::class, 'index'])->name('users'); 

    Route::get('/logout', [App\Http\Controllers\AuthController::class,'logout']);
});
 Route::get('/home',  [App\Http\Controllers\admin\DashbordController::class, 'index'])->name('home');

// Auth::routes();
