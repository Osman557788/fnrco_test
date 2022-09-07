<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function index() {
       
        $posts = Post::with(['user','files','likes',

        'comments'=> function($q){
             $q->with('user');
        }

     ])->get();

        return view('app',compact('posts'));
    }

    
    
    public function store (Request $request) {

        $request->validate([

            'title' => 'required|max:191',
            'description' => 'required',
            'images' => 'required',
            
        ]);

        $images = [];

        foreach($request->file('images') as $image){

            $image->storeAs( 'post' , $image->hashName(), 'public');

            $images[] = ['file' => $image->hashName()];
        }
        
        
        $post = Post::create([
                    'user_id' => auth()->user()->id ,
                    'title' => $request->title,
                    'description' => $request->description,
                ]);

       $post ->files()->createMany($images);
       
       return redirect()->route('index');
    }

    public function like(Request $request){
        if($request->post_id){

            Post::findOrFail($request->post_id)->likes()->create(['user_id'=>auth()->user()->id]);

            return 'success';
        }

    }



    public function destroy(Post $post)
    {
        foreach($post->files as $file) {
            Storage::disk('public')->delete('post/'.$file->file);
        }
        $post->delete();

        session()->flash('success','user hase deleted');
        
        return redirect()->back(); 
    }


    public function makeComment( Request $request){

        $post = Post::findOrFail($request->post_id);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment
        ]);

        return $comment->user()->first();
    }

    
}
