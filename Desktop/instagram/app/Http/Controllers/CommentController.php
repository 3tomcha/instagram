<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
  public function __invoke(Request $request, $id)
  {
    $article_id = $id;

    $comment = new Comment;
    $comment->user_id = auth()->user()->id;
    $comment->article_id = $article_id;
    $comment->comment = $request->input('value');
    $comment->save();

    // return $request->input('value');
    // 表示に必要な情報を返す
    return ['comment_user_name' => $comment->user->name, 
    'comment_comment' => $comment->comment,
    'comment_updated_at' => $comment->updated_at];
  }
}
