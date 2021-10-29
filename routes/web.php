<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ArticleController;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// -----------------------Backend Route--------------------------------
Route::middleware(['admin','auth'])->prefix('admin')->group(function(){
    // -------------------------Admin Route----------------------------------------------    
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');

    // -----------------------Article Route-----------------------------------------------

    
    Route::get('/articles/trash',[\App\Http\Controllers\ArticleController::class,'trashed'])->name('articles.trash');
    Route::put('/articles/{article}/restore',[\App\Http\Controllers\ArticleController::class,'restore'])->name('articles.restore');    
    Route::delete('/articles/erase/{article}',[\App\Http\Controllers\ArticleController::class,'erase'])->name('articles.erase');
    Route::resource('/articles', \App\Http\Controllers\ArticleController::class);


    Route::get('pages',[ArticleController::class,'index'])->name('admin.page');
    Route::get('tasks',[ArticleController::class,'index'])->name('admin.task');
    Route::get('categories',[ArticleController::class,'index'])->name('admin.category');

    // -----------------------Tag Route------------------------------------

    Route::resource('/tags', \App\Http\Controllers\TagController::class);
    Route::resource('/categories',\App\Http\Controllers\CategoryController::class);
    Route::post('/upload', [ArticleController::class,'upload']);
});
// Route::group(['prefix'=>'admin','middleware' =>['admin','auth'],'namespace'=>'admin'], function(){
//     Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
//     Route::get('articles',)->name('admin.articles');
// });


// -----------------------User Route--------------------------------

// Route::group(['prefix'=>'user','middleware' =>['user','auth'],'namespace'=>'user'], function(){
//     Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
// });
Route::middleware(['user','auth'])->prefix('user')->group(function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
});
