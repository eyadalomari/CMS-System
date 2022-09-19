<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    
    public function index(){
        $posts = auth()->user()->posts()->paginate(5);

        return view('admin.posts.index',['posts'=>$posts]);
    }


    public function show(Post $post){
        //$post = Post::findOrFail($id);
        return view('blog-post', ['post'=>$post]);
    }



    public function create(){
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }



    public function store(Request $request){

        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',     //'mimes:jpeg,jpg,png',
            'body'=>'required'
        ]);        

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('post-created-message', $inputs['title'].' post was created');

        return redirect()->route('post.index');
    }




    public function destroy(Post $post, Request $request){
        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('post-deleted-message', "Post was deleted");
        //OR -> Session::flash('message', "Post was deleted");
        return back();
    }




    public function edit(Post $post){
        //$this->authorize('view', $post); Commented cus authorize used in route
        return view('admin.posts.edit', ['post'=>$post]);
    }




    public function update(Post $post, Request $request){

        $inputs = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

    
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        

        $this->authorize('update', $post);

        $post->update();

        //auth()->user()->posts()->save($post); ---> this will change owner

        session()->flash('post-updated-message', $inputs['title'].' post was updated');

        return redirect()->route('post.index');
    }



}


