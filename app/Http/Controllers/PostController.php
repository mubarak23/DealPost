<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostComment;
use Illuminate\Http\Request;
use DB;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @return view with data
     */
    public function index()
    {
        //show all post with pagination
        $posts = Post::paginate(10);
        return view('posts')->with(['all_posts' => $posts]);

    }
    /**
     * Display a page for adding post.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function addPost()
    {
        //show the add post page
        return view('AddPost');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //collect user data and validate it
        //send the validate data to store method
        $data = $request->all();
        //set validation rules
            $validatedData = $request->validate([
                "name"     => "required|min:5",
                "email"  => "required",
                "title"  => "required|min:5",
                "body"  => "required|min:5|max:500"
                ]);
                $add_post = new Post();
                $add_post->name = $data['name'];
                $add_post->email = $data['email'];
                $add_post->title = $data['title'];
                $add_post->body = $data['body'];
                $add_post->save();
                if($process_store){ 
                    //return home
                    return redirect()->route('posts')->with('status', 'Add Post Successfully');
                }else{
                    //send back an error message
                    return redirect()->back()->withInput()->with('status', 'Unable to Add Post at This Time');
                }
                
            
    }

    /**
     * Store a newly created resource in storage.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show details of single post
        $post_details = Post::find($id);
        //pull list of comment attarch to this post
        $post_comment = PostComment::where('post_id', $id)->get();
        return view('single_details')->with(['post_details' => $post_details, 'comment' => $post_comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show a specfic post to edit
        $post = Post::find($id);
        return view('EditPost')->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //pull that particular post using it id
        //update it's content
        $data = $request->all();
            //find the post
            $edit_post = Post::find($id);
            $edit_post->name = $data['name'];
            $edit_post->email = $data['email'];
            $edit_post->body = $data['body'];
             if($edit_post->save()){
                return redirect()->route('posts')->with('status', 'Edit Post Successfully');
             }else{
                 //send back an error message
                return redirect()->back()->withInput()->with('status', 'Unable to Edit Post at This Time');
             }
    }

    /**
     * Remove the specified resource from storage.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //pull the particular post and delete it
        $post_id = Post::destroy($id);
        if($post_id){
            return redirect()->route('posts')->with('status', 'Post Deleted Successfully');
        }else{
           //send back an error message
                return redirect()->back()->with('status', 'Unable to Edit Post at This Time'); 
        }
    }
}
