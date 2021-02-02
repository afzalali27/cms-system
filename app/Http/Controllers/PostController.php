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
        
        // $posts = Post::all();
        $posts = auth()->user()->posts;
        // here we can use laravel pagination also

        // 5 posts per page
        $posts = auth()->user()->posts()->paginate(5);

        // dd($posts);

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
        $this->authorize('create',Post::class);
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
        $this->authorize('update',$post); // pass the policy to update post
        // we can also use update  here
        auth()->user()->posts()->save($post);
        Session::flash('post-updated','Post has updated Successfuly');

        // dd(request('image'));  // show data of image
        return redirect()->route('posts.index');
    }

    // delete
    public function destroy(Post $post){

        // delete only if it belongs to user
        $this->authorize('delete',$post);
        // or we can use can function
        // if(auth()->user()->can('view',$post)) then delete

        $post->delete(); // it will destroy any post comes to it , don't care
        // if it belongs to logged in user or not so we must need to authenticate user
        // one method is to check user id with post id like below
        // if(auth()->user()->id == $post->user_id) then delete otherwise do nothing

        // ohter than this we can add middleware and add policies to do this task

        Session::flash('message','Post Deleted Successfuly');
        return back();
    }
}
