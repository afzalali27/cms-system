<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Session;
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
        Session::flash('post-created','Post has created Successfuly');

        // dd(request('image'));  // show data of image
        return redirect()->route('posts.index');
    }

    public function edit(Post $post){
        return view('admin.posts.edit',['post'=>$post]);
    }
    public function update(Post $post){
        $inputs = request()->validate([
            // define rules here for validations
            'title'=>'required|min:8|max:255',
            'post_image'=>'file', // for diff formats
            'body'=>'required'
            // 'image'=>'mimes:jpeg,png,', // for diff formats
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        auth()->user()->posts()->save($post);
        Session::flash('post-updated','Post has updated Successfuly');

        // dd(request('image'));  // show data of image
        return redirect()->route('posts.index');
    }
    public function destroy(Post $post){
        $post->delete();
        Session::flash('message','Post Deleted Successfuly');
        return back();
    }
}
