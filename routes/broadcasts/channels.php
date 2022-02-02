<?php

declare(strict_types=1);

use Illuminate\Contracts\Auth\Access\Authorizable;

Broadcast::channel('cortex.categories.categories.index', function (Authorizable $user) {
    return $user->can('list', app('rinvex.categories.category'));
});
