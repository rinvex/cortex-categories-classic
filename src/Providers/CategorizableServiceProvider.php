<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Providers;

use Cortex\Categorizable\Models\Category;
use Illuminate\Support\ServiceProvider;
use Cortex\Categorizable\Console\Commands\SeedCommand;
use Cortex\Categorizable\Console\Commands\MigrateCommand;

class CategorizableServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.cortex.categorizable.migrate',
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
        // Bind eloquent models to IoC container
        $this->app->alias('rinvex.categorizable.category', Category::class);

        // Register artisan commands
        foreach ($this->commands as $key => $value) {
            $this->app->singleton($value, function ($app) use ($key) {
                return new $key();
            });
        }

        $this->commands(array_values($this->commands));
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
        $this->publishes([realpath(__DIR__.'/../../resources/lang') => resource_path('lang/vendor/cortex/categorizable')], 'lang');
        $this->publishes([realpath(__DIR__.'/../../resources/views') => resource_path('views/vendor/cortex/categorizable')], 'views');
    }
}
