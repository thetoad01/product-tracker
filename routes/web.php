<?php

use App\Notifications\ImportantStockUpdate;
use App\Stock;
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

Route::view('/', 'welcome')->name('welcome');

Route::get('/mail-preview', function () {
    $user = factory(\App\User::class)->create();

    return (new ImportantStockUpdate(Stock::first()))->toMail($user);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Logged in users only
Route::middleware('auth')->group(function () {
    Route::resource('retailer', 'RetailerController');
    Route::resource('product', 'ProductController');
    Route::resource('stock', 'StockController');
});
