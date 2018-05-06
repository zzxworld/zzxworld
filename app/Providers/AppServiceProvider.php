<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            \App\Models\Post::MORPH_NAME => 'App\Models\Post',
            \App\Models\Note::MORPH_NAME => 'App\Models\Note',
            \App\Models\NewsPost::MORPH_NAME => 'App\Models\NewsPost',
            \App\Models\Comment::MORPH_NAME => 'App\Models\Comment',
            \App\Models\LinuxCommand::MORPH_NAME => 'App\Models\LinuxCommand',
            \App\Models\Site::MORPH_NAME => 'App\Models\Site',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
