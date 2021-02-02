<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //

    public function index(){
        
        $posts = Post::all();

        return view('admin.posts.index', ['posts'=>$posts]);
    }
    public function show(Post $post){
        // as we are getting class object in param
        // so even by passing post id, it automatically find the 
        // post in post variable
        // Post::findOrFail($id);
        return view('blog-post',['post'=>$post]);
    }
    public function create(){
        
        return view('admin.posts.create');
    }

    public function store(){
        // validation of form ,so user can't submit empty form
        $inputs = request()->validate([
            // define rules here for validations
            'title'=>'required|min:8|max:255',
            'post_image'=>'file', // for diff formats
            'body'=>'required'
            // 'image'=>'mimes:jpeg,png,', // for diff formats
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        // dd(request('image'));  // show data of image
        return back();
    }
}
