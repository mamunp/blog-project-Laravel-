<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ZenBlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
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

Route::get('/',[ZenBlogController::class,'index'])->name('home');

Route::get('/about',[ZenBlogController::class,'about'])->name('about');
Route::get('/contact',[ZenBlogController::class,'contact'])->name('contact');
Route::get('/blog-category',[ZenBlogController::class,'category'])->name('blog.category');

Route::get('/user-register',[ZenBlogController::class,'userRegister'])->name('user.register');
Route::post('/user-register',[ZenBlogController::class,'saveUser'])->name('user.register');

Route::get('/user-login',[ZenBlogController::class,'userLogin'])->name('user.login');
Route::post('/user-login',[ZenBlogController::class,'loginCheck'])->name('user.login');

Route::group(['middleware'=>'blogUser'],function (){
    Route::get('/blog-details/{slug}',[ZenBlogController::class,'blogDetails'])->name('blog.details');
    Route::post('/new-comment',[CommentController::class,'saveComment'])->name('new.comment');
    Route::get('/user-logout',[ZenBlogController::class,'logout'])->name('user.logout');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/author',[AuthorController::class,'index'])->name('author');
    Route::post('/new-author',[AuthorController::class,'saveAuthor'])->name('new.author');

    Route::get('/category',[CategoryController::class,'index'])->name('category');
    Route::post('/category-create',[CategoryController::class,'save'])->name('category.create');

    Route::get('/blog',[BlogController::class,'index'])->name('blog');
    Route::post('/new-blog',[BlogController::class,'saveBlog'])->name('new.blog');
    Route::get('/manage-blog',[BlogController::class,'manageBlog'])->name('manage.blog');
    Route::get('/status/{id}',[BlogController::class,'status'])->name('status');

});

