<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Relations\Relation;

return function () {
    // Bind route models and constrains
    Route::pattern('category', '[a-zA-Z0-9-_]+');
    Route::model('category', config('rinvex.categories.models.category'));

    // Map relations
    Relation::morphMap([
        'category' => config('rinvex.categories.models.category'),
    ]);
};
