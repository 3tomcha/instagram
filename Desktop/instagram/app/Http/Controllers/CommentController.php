<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
  public function index(Request $request, $id)
  {
    // dd($request);

    $article_id = $id;

    $comment = new Comment;
    $comment->user_id = auth()->user()->id;
    $comment->article_id = $article_id;
    $comment->comment = $request->input('comment');
    $comment->save();

    return redirect('/');
  }
}
