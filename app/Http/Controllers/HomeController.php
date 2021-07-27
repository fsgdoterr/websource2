<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;

use App\Models\Comment;
use App\Models\Message;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $posts    = Post::orderBy('id', 'desc')->limit(4)->get();
        $comments = Comment::orderBy('id', 'desc')->limit(4)->get();
        return view('home', [
            'posts'    => $posts,
            'comments' => $comments,
        ]);
    }

    public function message(Request $request) {
        $request->validate([
            'name'    => 'required|string|',
            'email'   => 'required|email|',
            'message' => 'required|string|max:1500',
        ]);

        Message::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'message'  => $request->message,
        ]);

        return redirect()->back();
    }

    public function category_create($slug) {
        $post_id = Category::where('slug', '=', $slug)->first()->id;
        $posts = Post::where('category', '=', $post_id)->orderBy('id', 'desc')->get();
        return view('category', [ 'posts' => $posts ]);
    }

    public function search(Request $request) {
        $posts = Post::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('search', ['posts' => $posts]);
    }
}
