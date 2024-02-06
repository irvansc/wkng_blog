<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/','front.pages.home')->name('home');

Route::get('/article/{any}',[BlogController::class,'readPost'])->name('read_post');
Route::get('/category/{any}',[BlogController::class,'categoryPost'])->name('category_post');
Route::get('/tag/{any}',[BlogController::class,'tagPost'])->name('tag_post');
Route::get('/search',[BlogController::class,'searchBlog'])->name('search_post');

