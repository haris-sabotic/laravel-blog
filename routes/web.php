<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('home', ["posts" => DB::table('posts')->paginate(5)]);
});
Route::get('/home', function () {
    return view('home', ["posts" => DB::table('posts')->paginate(5)]);
});


Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');


Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/my-posts', function () {
        return view('my_posts', ["posts" => Post::all()->where('user_id', '=', auth()->user()->id)]);
    });

    Route::get('/new-post', [NewPostController::class, 'show'])->name('new_post.show');
    Route::post('/new-post', [NewPostController::class, 'post'])->name('new_post.perform');

    Route::post('/post/delete/{id}', function ($id) {
        if (Post::find($id)->user_id == auth()->user()->id || auth()->user()->is_admin) {
            Post::find($id)->delete();
        }

        return back();
    })->name('del_post.perform');

    Route::post('/post/delete-user/{id}', function ($id) {
        $user = Post::find($id)->user_id;
        if (auth()->user()->is_admin && $user != auth()->user()->id) {
            $posts = Post::all()->where('user_id', '=', $user);
            foreach ($posts as $post) {
                $post->user_id = auth()->user()->id;
                $post->save();
            }

            User::find($user)->delete();
        }

        return back();
    })->name('del_post_user.perform');
});
