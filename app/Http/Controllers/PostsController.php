<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; //When using Eloquent to send queries
use DB; //When using SQL to send queries
Use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
    
    public function index()
    {      //--QUERYING USING ELEQUENT---
         //To select all from the table
       // $posts = Post::all();

         //selecting by specific field results
        /// return Post::where('title', 'Post Two')->get();

        //To selct all and order them
       //$posts = Post::orderBy('created_at','desc')->get();

       //To select limited results
      // $posts = Post::orderBy('title','desc')->take(1)->get();


       //--QUERYING USING ELEQUENT---
      // $posts = DB::select('SELECT * FROM posts');

      //---PAGINATION---
      $posts = Post::orderBy('created_at','desc')->paginate(10);





        return  view('posts.index')->with('posts', $posts);
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
        //validation
        $this->validate($request, ['title'=> 'required', 
                 'body'=> 'required',
                'cover_image'=>'image|nullable|max:1999']);
            if($request->hasFile('cover_image')){
                //Get filr name with the extension
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName ();
                
                //Get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //File name to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //upload the image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            } else{
                $fileNameToStore = 'noimage.jpg';
            }

        //create post
        //NB: Collecting data from the form and sending them in to the database using Eloquent
        $post = new Post(); //we declare a variable that will collect data from the fields.
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
  
        $post= Post::find($id);

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
        //check for correct user 
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');

        }
        return view('posts.edit')->with('post', $post);


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
         //validation
         $this->validate($request, ['title'=> 'required', 'body'=> 'required']);
         
         if($request->hasFile('cover_image')){
            //Get filr name with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName ();
            
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 
         //create post
         //NB: Collecting data from the form and sending them in to the database using Eloquent
         $post = Post::find($id); //we declare a variable that will collect data from the fields.
         $post->title = $request->input('title');
         $post->body = $request->input('body');
         if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
         }
         $post->save();
 
         return redirect('/posts')->with('success', 'Post Updated');
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
        //check for correct user 
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');

        }if($post->cover_image != 'noimage.jpg'){
            //Delete 
            Storage::delete('public/cover_images/'.$post->cover_image);

        }

        $post->delete();
        
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
