<?php

declare(strict_types=1);

Broadcast::channel('adminarea-categories-index', function ($user) {
    return $user->can('list', app('rinvex.categories.category'));
}, ['guards' => ['admin']]);
