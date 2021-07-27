<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function post_create($slug) {
        $post = Post::where('slug', '=', $slug)->first();
        if($post!=null){
            $author = User::where('id', '=', $post->user_id)->first();
            $comments = Comment::where('post_id', '=', $post->id)->get();
            
            return view('post', [
                'post'     => $post,
                'author'   => $author,
                'comments' => $comments,
                'slug'     => $slug,
            ]); 
        } else {
            return back();
        }
    }

    public function post_store($slug, Request $request) {
        
        $request->validate([
            'comment'       => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id'     => auth()->user()->id,
            'post_id'     => Post::where('slug', '=', $slug)->first()->id,
            'content'     => $request->comment,
        ]);
        
        return redirect()->route('post.create', $slug);
    }
}
