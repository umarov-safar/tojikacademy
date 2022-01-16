<?php

namespace App\Providers;

use App\Repositories\ArticleInterfaceRepository;
use App\Repositories\ArticleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleInterfaceRepository::class, ArticleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
