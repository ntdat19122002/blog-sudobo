<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Like;
use App\Models\LikeComment;
use App\Models\Comment;

class LikeController extends Controller
{
    public function like(Request $request,$id)
    {
        
        $blog = Blog::find($id);
        $like =Like::where('like_by',$request->session()->get('user'))->where('blog_id',$id)->first();
        if($like){
            $blog->like_number--;
            $like->delete();
        }else{
            $like =new Like;
            $blog->like_number++;
            $like->like_by = $request->session()->get('user');
            $like->blog_id = $id;
            $like->save();
        }
        $blog->save();

        return response()->json(['like_number'=>$blog->like_number]);
    }

    public function like_comment(Request $request,$id)
    {
        
        $comment = Comment::find($id);
        $like =LikeComment::where(['like_by'=>$request->session()->get('user'),'comment_id'=>$id])->first();
        if($like){
            $comment->like_number--;
            $like->delete();
        }else{
            $like =new LikeComment;
            $comment->like_number++;
            $like->like_by = $request->session()->get('user');
            $like->comment_id = $id;
            $like->save();
        }
        $comment->save();

        return response()->json(['like_number'=>$comment->like_number]);
    }
}
