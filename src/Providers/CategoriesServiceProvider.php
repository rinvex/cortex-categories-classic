<?php

declare(strict_types=1);

namespace Cortex\Categories\Providers;

use Illuminate\Routing\Router;
use Cortex\Categories\Models\Category;
use Illuminate\Support\ServiceProvider;
use Rinvex\Support\Traits\ConsoleTools;
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
        ! $this->app->runningInConsole() || $this->registersCommands();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router): void
    {
        // Bind route models and constrains
        $router->pattern('category', '[a-zA-Z0-9-]+');
        $router->model('category', config('rinvex.categories.models.category'));

        // Map relations
        Relation::morphMap([
            'category' => config('rinvex.categories.models.category'),
        ]);

        // Load resources
        require __DIR__.'/../../routes/breadcrumbs/adminarea.php';
        $this->loadRoutesFrom(__DIR__.'/../../routes/web/adminarea.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'cortex/categories');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'cortex/categories');
        $this->app->runningInConsole() || $this->app->afterResolving('blade.compiler', function () {
            require __DIR__.'/../../routes/menus/adminarea.php';
        });

        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishesLang('cortex/categories');
        ! $this->app->runningInConsole() || $this->publishesViews('cortex/categories');
        ! $this->app->runningInConsole() || $this->publishesMigrations('cortex/categories');
    }
}
