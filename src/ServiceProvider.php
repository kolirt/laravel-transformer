<?php

namespace Kolirt\Transformer;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Commands
     *
     * @var array
     */
    protected $commands = [
        Commands\InstallCommand::class
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/transformer.php', 'transformer');

        $this->publishes([
            __DIR__ . '/../config/transformer.php' => config_path('transformer.php')
        ]);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}