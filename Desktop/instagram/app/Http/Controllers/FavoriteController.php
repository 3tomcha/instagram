<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Article;
use App\Http\Resources\FavoriteCollection;

class FavoriteController extends Controller
{
  public function __invoke($id)
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
    // dd(Article::all()[0]->favorite);

    $favorites = Article::all()[0]->favorite;
    $article_favorite_users = [];

    foreach ($favorites as $favorite) {
      // dump($favorite->user->name);
      $article_favorite_users[] = $favorite->user->name;
    }
    return ['article_favorite_users'=>$article_favorite_users];
    // dd("aa");

    // dd(new FavoriteCollection(Favorite::all()));
    // return "aaa";
    // return redirect('/');
  }
}
