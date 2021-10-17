<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\User;
use \App\BlogPost;
class BlogPostController extends Controller
{ public function __construct()
{
$this->middleware('auth');
}

    public function index()
    {
        $blogPosts = \App\BlogPost::all();
        return view('blogPosts.postYayinla',compact('blogPosts'));
    }
    public function postEkle()
    {
        $blogPosts = \App\BlogPost::all();
        return view('blogPosts.create',compact('blogPosts'));
    }
    public function postSil(Request $request)
    {
        dd($request->id);
        $blog = BlogPost::find( $blog->id );
        $blog->delete();
        return redirect('/blog');
    }
    public function postKaydet(Request $request)
    {
        $user = Auth::user()->name;   
        $request->request->add(['author' => $user]);
        $blogPosts = \App\BlogPost::create($this->validatedData());
        
        return redirect('/blog');

    }
       protected function validatedData()
    {

      return request()->validate([
            'content'=>'required',
            'title'=>'required',
            'author'=>'required',
        ]);

    }
        public function show(\App\BlogPost $post)
    {
        return view('blogPosts.show', compact('post'));
    }
}