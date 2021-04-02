<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use DB;

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth', ['except' => ['index', ]]);
        //$this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$title = 'post index';
        //return view('post.index')->with('title', $title);

                /** 
         * use App\Models\Post;
         */
        
        //$posts = Post::all();

        /**
         * orderBy
         */
        //$posts = Post::orderBy('title', 'desc')->get();
        
        /**
         * limit
         */
        //$posts = Post::orderBy('title', 'desc')->take(2)->get();

        /**
         * where
         */
        //return Post::where('title', 'Post two')->get();
        
        /**
         * pagination
         */
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        /**
         * use DB;
         */
        //$posts = DB::select('SELECT * FROM posts');

        return view('posts.index')->with('posts', $posts);
        //return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // hande file upload
        if ( $request->hasFile('cover_image') ) {
            // get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get fust extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else {
            $fileNameToStore = 'noimage.jpg';
        }

        // create posst
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post creted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);
        // check for correct user
        // if(auth()->user()->id !== $post->id && auth()->user()->role !== 'admin'){
        //     return redirect('/posts')->with('error', 'Unauthorized page');
        // }

        if(auth()->user()->id == $post->user_id || auth()->user()->role == 'admin'){
            return view('posts.edit')->with('post', $post);
        }

        // if(auth()->user()->id == $post->user_id){
        //     return view('posts.edit')->with('post', $post);
        // }elseif (auth()->user()->role == 'admin'){
        //     return view('posts.edit')->with('post', $post);
        // }

        return redirect('/posts')->with('error', 'Unauthorized page');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        // hande file upload
        if ( $request->hasFile('cover_image') ) {
            // get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get fust extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ( $request->hasFile('cover_image') ) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);
        // check for correct user
        if(auth()->user()->id !== $post->id && auth()->user()->role !== 'admin'){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        if ( $post->cover_image != 'noimage.jpg' ) {
            // delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('body', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('posts.search', compact('posts'));
    }
}
