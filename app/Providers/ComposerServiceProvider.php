<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        //$categories = \App\Category::all(['name','slug']);
        //view()->share('categories', $categories);

        view()->composer('*', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
