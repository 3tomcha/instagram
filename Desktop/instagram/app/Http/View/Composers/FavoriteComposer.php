<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

class FavoriteComposer
{
    /**
     * データをビューと結合
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
      dump($view);
      dump($view->__currentLoopData);
      foreach ($view->__currentLoopData as $article) {
        $heart = 'far';
        $fav_user_names = [];
        foreach($article->favorite as $fav):
          $fav_user_names[] = $fav->user->name;
          if($fav->user->id == auth()->user()->id){
            $heart = 'fas';
          }
          endforeach;
          if(count($fav_user_names) > 0){
            $fav_message = implode(" ", $fav_user_names)."がいいねしました";
          }
      }
        // $view->with('count', $this->users->count());
    }
}
