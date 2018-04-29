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
            '01' => 'App\Models\Post',
            '02' => 'App\Models\Note',
            \App\Models\NewsPost::MORPH_NAME => 'App\Models\NewsPost',
            '04' => 'App\Models\Comment',
            '05' => 'App\Models\LinuxCommand',
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
