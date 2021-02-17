<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/profile/create', [App\Http\Controllers\ProfileController::class, 'create']);
//Route::get('/statistic', [App\Http\Controllers\ProfileController::class, 'statistic'])->name('profile.statistic');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'postCreate'])->name('profile.postCreate');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit']);
Route::post('/profile/{id}/update', [App\Http\Controllers\ProfileController::class, 'postEdit'])->name('profile.postEdit');

Route::get('/statistic/day', [App\Http\Controllers\ItemController::class, 'index'])->name('statisticDay');
Route::get('item/getDay', [App\Http\Controllers\ItemController::class, 'getDay'])->name('item.getDay');

Route::get('/statistic/range', [App\Http\Controllers\ItemController::class, 'rangeIndex'])->name('statisticRange');
Route::get('item/getRange', [App\Http\Controllers\ItemController::class, 'getRange'])->name('item.getRange');

Route::resource('item', App\Http\Controllers\ItemController::class);

