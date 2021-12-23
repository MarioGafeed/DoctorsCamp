<?php

namespace App\Providers;

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
      $this->app->bind(
          'App\Http\Interfaces\UserInterface',
          'App\Http\Repositories\UserRepository'
      );
      $this->app->bind(
          'App\Http\Interfaces\CategoryInterface',
          'App\Http\Repositories\CategoryRepository'
      );
      $this->app->bind(
          'App\Http\Interfaces\PostInterface',
          'App\Http\Repositories\PostRepository'
      );
      $this->app->bind(
          'App\Http\Interfaces\VpostInterface',
          'App\Http\Repositories\VpostRepository'
      );
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
