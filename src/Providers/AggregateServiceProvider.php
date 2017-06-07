<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Providers;

use Illuminate\Support\AggregateServiceProvider as BaseAggregateServiceProvider;
use Rinvex\Categorizable\CategorizableServiceProvider as BaseCategorizableServiceProvider;

class AggregateServiceProvider extends BaseAggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        BaseCategorizableServiceProvider::class,
        CategorizableServiceProvider::class,
    ];
}
