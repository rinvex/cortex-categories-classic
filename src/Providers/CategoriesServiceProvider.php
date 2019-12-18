<?php

declare(strict_types=1);

namespace Cortex\Categories\Providers;

use Illuminate\Routing\Router;
use Cortex\Categories\Models\Category;
use Illuminate\Support\ServiceProvider;
use Rinvex\Support\Traits\ConsoleTools;
use Illuminate\Contracts\Events\Dispatcher;
use Cortex\Categories\Console\Commands\SeedCommand;
use Illuminate\Database\Eloquent\Relations\Relation;
use Cortex\Categories\Console\Commands\InstallCommand;
use Cortex\Categories\Console\Commands\MigrateCommand;
use Cortex\Categories\Console\Commands\PublishCommand;
use Cortex\Categories\Console\Commands\RollbackCommand;

class CategoriesServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        SeedCommand::class => 'command.cortex.categories.seed',
        InstallCommand::class => 'command.cortex.categories.install',
        MigrateCommand::class => 'command.cortex.categories.migrate',
        PublishCommand::class => 'command.cortex.categories.publish',
        RollbackCommand::class => 'command.cortex.categories.rollback',
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
    public function register(): void
    {
        // Bind eloquent models to IoC container
        $this->app['config']['rinvex.categories.models.category'] === Category::class
        || $this->app->alias('rinvex.categories.category', Category::class);

        // Register console commands
        ! $this->app->runningInConsole() || $this->registerCommands();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $dispatcher): void
    {
        // Bind route models and constrains
        $router->pattern('category', '[a-zA-Z0-9-_]+');
        $router->model('category', config('rinvex.categories.models.category'));

        // Map relations
        Relation::morphMap([
            'category' => config('rinvex.categories.models.category'),
        ]);

        // Load resources
        $this->loadRoutesFrom(__DIR__.'/../../routes/web/adminarea.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'cortex/categories');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'cortex/categories');

        $this->app->runningInConsole() || $dispatcher->listen('accessarea.ready', function ($accessarea) {
            ! file_exists($menus = __DIR__."/../../routes/menus/{$accessarea}.php") || require $menus;
            ! file_exists($breadcrumbs = __DIR__."/../../routes/breadcrumbs/{$accessarea}.php") || require $breadcrumbs;
        });

        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishesLang('cortex/categories', true);
        ! $this->app->runningInConsole() || $this->publishesViews('cortex/categories', true);
        ! $this->app->runningInConsole() || $this->publishesMigrations('cortex/categories', true);
    }
}
