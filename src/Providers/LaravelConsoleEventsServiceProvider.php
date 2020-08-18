<?php

namespace MarekMikula\LaravelConsoleEvents\Providers;

use Illuminate\Console\Events\ArtisanStarting;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use MarekMikula\LaravelConsoleEvents\Listeners\ArtisanStartingListener;

class LaravelConsoleEventsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            /**
             * Register listeners
             */
            Event::listen(ArtisanStarting::class, ArtisanStartingListener::class);
        }
    }

    public function register()
    {
        //
    }
}
