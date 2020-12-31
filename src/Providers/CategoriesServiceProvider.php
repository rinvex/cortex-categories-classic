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
use Cortex\Categories\Console\Commands\UnloadCommand;
use Cortex\Categories\Console\Commands\InstallCommand;
use Cortex\Categories\Console\Commands\MigrateCommand;
use Cortex\Categories\Console\Commands\PublishCommand;
use Cortex\Categories\Console\Commands\ActivateCommand;
use Cortex\Categories\Console\Commands\AutoloadCommand;
use Cortex\Categories\Console\Commands\RollbackCommand;
use Cortex\Categories\Console\Commands\DeactivateCommand;

class CategoriesServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        ActivateCommand::class => 'command.cortex.categories.activate',
        DeactivateCommand::class => 'command.cortex.categories.deactivate',
        AutoloadCommand::class => 'command.cortex.categories.autoload',
        UnloadCommand::class => 'command.cortex.categories.unload',

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
        $this->registerCommands($this->commands);
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
    }
}
