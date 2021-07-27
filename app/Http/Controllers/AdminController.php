<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function admin_create() {
        if(auth()->check() && auth()->user()->permissions == 1)
        {
            $categories = Category::all();
            $messages = Message::orderBy('id', 'desc')->get();
            return view('admin.admin', ['categories' => $categories, 'messages' => $messages]);
        }
        else {
            return redirect()->back();
        }
    }
    
    public function category_delete(Request $request) {
        $category = Category::where('id', '=', $request->id);
        $category->delete();
        return redirect()->back();
    }
    
    public function category_store(Request $request) {
        $request->validate([
            'category' => 'required|string|max:30',
        ]);
        Category::create([
            'name' => $request->category,
            'slug' => Str::slug($request->category),
        ]);
        return redirect()->back();
    }
}
