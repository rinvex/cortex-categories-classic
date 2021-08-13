<?php

declare(strict_types=1);

namespace Cortex\Categories\Providers;

use Cortex\Categories\Models\Category;
use Illuminate\Support\ServiceProvider;
use Rinvex\Support\Traits\ConsoleTools;
use Illuminate\Database\Eloquent\Relations\Relation;

class CategoriesServiceProvider extends ServiceProvider
{
    use ConsoleTools;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Map relations
        Relation::morphMap([
            'category' => config('rinvex.categories.models.category'),
        ]);
    }
}
