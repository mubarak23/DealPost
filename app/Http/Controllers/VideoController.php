<?php

namespace App\Http\Controllers;

use App\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use DB;
use app\VideoComment;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @return View with data
     */
    public function index()
    {
        //show all post with pagination
        $videos = Video::paginate(10);
        return view('videos')->with(['all_videos' => $videos ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddVideo()
    {
        //show the add post page
        return view('AddVideo');
    }

    /**
     * Show the form for creating a new resource.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //collect user data and validate it
        //send the validate data to store method
        $data = $request->all();
        //return $request->file('video');
        //set validation rules
            $validatedData = $request->validate([
                "name"     => "required|min:5",
                "email"  => "required",
                "title"  => "required|min:5"
                ]);
            //process video to Storage Location
            if ($request->hasFile('video')) {
            $request->file('video');
            $filename = $request->image->getClientOriginalName();
            $filesize = $request->image->getClientSize();
            $request->image->storeAs('public/uploadVideo', $filename);
            //Create a new post model
            $add_video = new Video();
            $add_video->name = $data['name'];
            $add_video->email = $data['email'];
            $add_video->title = $data['title'];
            $add_video->video_name = $filename;
            $add_video->save();
            return redirect()->route('video')->with('status', 'Add Video Successfully');
        }else{
            //send back an error message
            return redirect()->back()->withInput()->with('status', 'Unable to Upload Video at This Time');
        }
           
    }

    /**
     * Store a newly created resource in storage.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com> 
     * @return \Illuminate\Http\Response
     */
    public function store($data, $filename)
    {
        
    }

    /**
     * Display the specified resource.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \App\video  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show details of single post
        $video_details = video::find($id);
        //pull list of comment attarch to this post
        $video_comment = VideoComment::where('video_id', $id)->get();
        return view('single_details')->with(['video_details' => $video_details, 'comment' => $video_comment]);
    }

    /**
     * Show the form for editing the specified resource.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \App\video  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //show a specfic post to edit
        $video = Video::find($id);
        return view('edit_video')->with(['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\video  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //pull that particular post using it id
        //update it's content
        $data = $request->all();
            //find the post
            $edit_post = Video::find($id);
            $edit_video->name = $data['name'];
            $edit_video->email = $data['email'];
            $edit_video = $data['title'];
             if($edit_post->save()){
                DB::commit();
                return redirect()->route('videos')->with('status', 'Edit Video Successfully');
             }else{
                 //send back an error message
                return redirect()->back()->withInput()->with('status', 'Unable to Edit Video at This Time');
             }

        
    }

    /**
     * Remove the specified resource from storage.
     * @author  Mubarak Aminu <mubarakaminu340@gmail.com>
     * @param  \App\video  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //pull the particular post and delete it
        $post_id = Video::destroy($id);
        if($post_id){
            return redirect()->route('posts')->with('status', 'Post Deleted Successfully');
        }else{
           //send back an error message
                return redirect()->back()->with('status', 'Unable to Delete Post at This Time'); 
        }

    }
}
