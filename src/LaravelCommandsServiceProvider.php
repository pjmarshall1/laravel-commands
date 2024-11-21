<?php

namespace Pjmarshall1\LaravelCommands;

use Illuminate\Support\ServiceProvider;

class LaravelCommandsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                MakeComponentCommand::class,
                MakePageCommand::class,
                MakePestTestCommand::class,
            ]);
        }
    }
}
