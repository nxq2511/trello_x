<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repository\Post\PostInterface::class,
            \App\Repository\Post\PostRepository::class
        );

        $this->app->singleton(
            \App\Repository\User\UserInterface::class,
            \App\Repository\User\UserRepository::class
        );
    }
}
