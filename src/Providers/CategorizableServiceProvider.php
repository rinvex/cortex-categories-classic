<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Providers;

use Illuminate\Support\ServiceProvider;
use Cortex\Categorizable\Console\Commands\SeedCommand;
use Cortex\Categorizable\Console\Commands\InstallCommand;
use Cortex\Categorizable\Console\Commands\MigrateCommand;
use Cortex\Categorizable\Console\Commands\PublishCommand;

class CategorizableServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.cortex.categorizable.migrate',
        PublishCommand::class => 'command.cortex.categorizable.publish',
        InstallCommand::class => 'command.cortex.categorizable.install',
        SeedCommand::class => 'command.cortex.categorizable.seed',
    ];

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        // Register console commands
        ! $this->app->runningInConsole() || $this->registerCommands();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load resources
        require __DIR__.'/../../routes/breadcrumbs.php';
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'cortex/categorizable');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'cortex/categorizable');
        $this->app->afterResolving('blade.compiler', function () {
            require __DIR__.'/../../routes/menus.php';
        });

        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishResources();
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    protected function publishResources()
    {
        $this->publishes([realpath(__DIR__.'/../../resources/lang') => resource_path('lang/vendor/cortex/categorizable')], 'cortex-categorizable-lang');
        $this->publishes([realpath(__DIR__.'/../../resources/views') => resource_path('views/vendor/cortex/categorizable')], 'cortex-categorizable-views');
    }

    /**
     * Register console commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        // Register artisan commands
        foreach ($this->commands as $key => $value) {
            $this->app->singleton($value, function ($app) use ($key) {
                return new $key();
            });
        }

        $this->commands(array_values($this->commands));
    }
}
