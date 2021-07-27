<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register_create() {
        if(!auth()->check())
            return view('user.create');
        else return redirect()->home();
    }

    public function register_store(Request $request) {
        
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'Successful registration');
        Auth::login($user);
        return redirect()->home();

    }

    public function login_create() {
        if(!auth()->check())
            return view('user.login');
        else return redirect()->home();
    }

    public function login_store(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->home();
        } else {
            return redirect()->back();
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.create');
    }

    public function account_show(User $id) {
        $categories = Category::all();
        $posts = Post::where('user_id', '=' , $id->id)->get();
        $rows = $posts->count();
        return view('user.account', ['id' => $id, 'posts' => $posts, 'rows' => $rows, 'categories' => $categories]);
    }

    public function account_store(User $id, Request $request) {
        
        $request->validate([
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'       => 'required|string|max:30',
            'description' => 'required|string|max:100',
            'content'     => 'required|string|max:10000',
            'category'    => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $imagePath = 'images/user' . $id->id;
        $request->image->move(public_path($imagePath), $imageName);
        $image = $imagePath . '/' . $imageName;

        Post::create([
            'image_path'  => $image,
            'name'        => $request->title,
            'slug'        => time() . Str::slug($request->title),
            'description' => $request->description,
            'content'     => $request->content,
            'user_id'     => $id->id,
            'category'    => $request->category,
        ]);
        
        return redirect()->route('account.show', $id->id);
    }

    public function edit_show(User $id) {
        return view('user.edit', ['id' => $id]);
    }

    public function edit_store(User $id, Request $request) {
        $request->validate([
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'description' => 'string|max:800|nullable',
        ]);
        //dd($request->all());

        $user = User::find(1);
        if($request->image != null) {
            //dd($request->all());
            $imageName = time().'.'.$request->image->extension();
            $imagePath = 'images/user' . $id->id;
            $request->image->move(public_path($imagePath), $imageName);
            $image = $imagePath . '/' . $imageName;
            $user->image_path = $image;
        }
        if($request->description != null){
            $description = $request->description;
            $user->description = $description;
        }
        $user->save();
        
        return redirect()->route('account.show', auth()->user()->id);
    }
}
