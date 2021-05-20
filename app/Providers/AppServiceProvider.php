<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;

use App\Models\Tag;

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
    public function boot(){

        Schema::defaultStringLength(222);

        Paginator::useBootstrap();

        view()->composer('*',function ($view) {
            
            $tags = Tag::paginate(7);
            $view->with('tags',$tags);
        });
    
    }
}
