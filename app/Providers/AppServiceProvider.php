<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
       // クラスベースのコンポーザを使用する
       // View::composer(
       //   'layouts/favorite', 'App\Http\View\Composers\FavoriteComposer'
       // );
     }
   }
