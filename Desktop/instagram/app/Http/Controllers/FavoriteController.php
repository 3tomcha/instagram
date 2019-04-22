<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;

class FavoriteController extends Controller
{
  public function index($id)
  {
    $article_id = $id;
    $user_id = auth()->user()->id;
    $targetFavorite = Favorite::where('article_id',$article_id)->where('user_id',$user_id);

    // もしすでに登録されている場合は、削除処理
    if (count($targetFavorite->get()) > 0) {
      $targetFavorite->delete();

    // 新規登録処理
    }else{
      $favorite = new Favorite;
      $favorite->user_id = $user_id;
      $favorite->article_id = $article_id;
      $favorite->save();
    }
    return redirect('/');
  }
}
