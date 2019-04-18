<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class PostController extends Controller
{
    public function create(){
      return \view('create');
    }

    public function store(Request $request){
      $upload_file_name = $request->file('image')->store('images');

      $article = new Article;
      $article->caption = $request->input('caption');
      $article->image = basename($upload_file_name);
      $article->user_id = auth()->user()->id;
      $article->save();
      return \view('create');
    }
}
