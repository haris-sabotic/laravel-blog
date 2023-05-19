<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\NewPostRequest;

class NewPostController extends Controller
{
    /**
     * Display new post page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('new_post');
    }

    /**
     * Handle new post request
     * 
     * @param NewPostRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function post(NewPostRequest $request)
    {
        $post = Post::create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'content' => $request->validated('content'),
            'slug' => Str::slug($request->title, '_') . date("Y-m-d"),
            'published_at' => date("Y-m-d"),
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/post/' . $post->slug);
    }
}
