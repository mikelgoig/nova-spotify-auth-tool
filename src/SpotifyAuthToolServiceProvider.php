<?php

namespace Mgoigfer\SpotifyAuthTool;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Mgoigfer\SpotifyAuthTool\Http\Middleware\Authorize;

class SpotifyAuthToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations/2018_11_15_000000_create_spotify_table.php' => database_path('migrations/2018_11_15_000000_create_spotify_table.php'),
            ], 'migrations');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-spotify-auth-tool');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/nova-spotify-auth-tool')
            ->group(__DIR__.'/../routes/web.php');

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/nova-spotify-auth-tool')
            ->group(__DIR__.'/../routes/api.php');
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
