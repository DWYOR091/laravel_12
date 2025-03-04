<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{


    public function index()
    {
        $comment = Comment::with('blog')->get();
        return $comment;
    }
    public function store(Request $req, $blog_id)
    {
        $req->validate([
            'comment' => 'required',
        ]);

        $data = [
            'blog_id' => $req->blog_id,
            'comment_text' => $req->comment
        ];
        // return $req;
        // Comment::create($req->all());
        Comment::create($data);
        Session::flash('message', 'Comment successfully!');

        return redirect()->route('blog.show', ['blog' => $blog_id]);
    }
}
