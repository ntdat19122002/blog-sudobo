<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Like;
use App\Models\LikeComment;
use App\Models\Comment;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $likes = Like::where('like_by',$request->session()->get('user'))->get();
        $like_id = [];
        for($i=0;$i<count($likes);$i++){
            $like_id[] = $likes[$i]->blog_id;
        }
        $data = Blog::latest()->paginate(5);

        return view('components.blogs.home', compact('data','like_id'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function my_blogs(Request $request)
    {
        $data = DB::table('blogs')->where('blog_owner',$request->session()->get('user'))->paginate(5);

        return view('components.blogs.home', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function our_blogs($username)
    {
        $data = DB::table('blogs')->where('blog_owner',$username)->paginate(5);

        return view('components.blogs.home', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $data = DB::table('blogs')->where('blog_title','like','%'.$request->search_title.'%')->paginate(5);
        return view('components.blogs.home', compact('data'));
    }

    public function create()
    {
        return view('components.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_title'         =>  'required',
            'blog_description'       =>  'required',
            'blog_image'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);
        
        $file_name = time() . '.' . request()->blog_image->getClientOriginalExtension();

        request()->blog_image->move(public_path('images'), $file_name);

        $blog = new Blog;

        $blog->blog_title = $request->blog_title;
        $blog->blog_description = $request->blog_description;
        $blog->blog_category = $request->blog_category;
        $blog->blog_image = $file_name;
        $blog->blog_content = $request->content;
        $blog->blog_owner = $request->session()->get('user');

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog, Request $request)
    {
        $likes = LikeComment::where('like_by',$request->session()->get('user'))->get();
        $like_id = [];
        for($i=0;$i<count($likes);$i++){
            $like_id[] = $likes[$i]->comment_id;
        }
        $comments = Comment::where('blog_id',$blog->id)->orderBy('created_at', 'DESC')->get();
        return view('components.blogs.show', compact('blog','comments','like_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('components.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Blog $blog)
    {
        dd($request->all());
        $blog_image = $request->hidden_blog_image;

        if($request->blog_image != '')
        {
            $blog_image = time() . '.' . request()->blog_image->getClientOriginalExtension();

            request()->blog_image->move(public_path('images'), $blog_image);
        }
        $blog = Blog::find($request->hidden_id);

        $blog->blog_title = $request->blog_title;

        $blog->blog_description = $request->blog_description;

        $blog->blog_category = $request->blog_category;

        $blog->blog_image = $blog_image;

        $blog->blog_content =$request->content;

        $blog->save();

        return redirect('blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog Data deleted successfully');
    }
}
