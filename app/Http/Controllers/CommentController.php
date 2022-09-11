<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog){
        $comment = new Comment;
        $comment->blog_id = $request->hidden_id;
        $comment->comment_by = $request->session()->get('user');
        $comment->content = $request->comment;

        $comment->save();
        $comments = Comment::where('blog_id',$request->hidden_id)->get();
        return redirect()->back();
    }

    public function reply(Request $request, Blog $blog ,$id){
 
        $comment = new Comment;
        $comment->blog_id = $request->hidden_id;
        $comment->comment_by = $request->session()->get('user');
        $comment->content = $request->input('replyComment'.$id);
        $comment->reply_id = $id;

        $comment->save();
        $comments = Comment::where('blog_id',$request->hidden_id)->get();
        return redirect()->back();
    }
}
