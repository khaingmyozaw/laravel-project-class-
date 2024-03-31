<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;  // Authorization

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('delete-article', function($user, $article){
            // if($user->id == $article->user_id) {
            //     return true;
            // }else {
            //     return false;
            // }

            return $user->id == $article->user_id;
        });


        Gate::define('delete-comment', function($user, $comment) {
            return $user->id == $comment->user_id
                or $user->id == $comment->article->user_id;
        });
    }
}
