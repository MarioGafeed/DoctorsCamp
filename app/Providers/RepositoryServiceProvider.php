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
          'App\Http\Interfaces\categoryInterface',
          'App\Http\Repositories\CategoryRepository'
      );
      $this->app->bind(
          'App\Http\Interfaces\postInterface',
          'App\Http\Repositories\PostRepository'
      );
      $this->app->bind(
          'App\Http\Interfaces\vpostInterface',
          'App\Http\Repositories\VpostRepository'
      );
      $this->app->bind(
          'App\Http\Interfaces\eventInterface',
          'App\Http\Repositories\EventRepository'
      );
      $this->app->bind(
          'App\Http\Interfaces\imageInterface',
          'App\Http\Repositories\ImageRepository'
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
