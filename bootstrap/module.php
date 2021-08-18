<?php

declare(strict_types=1);

return function () {
    // Bind route models and constrains
    Route::pattern('category', '[a-zA-Z0-9-_]+');
    Route::model('category', config('rinvex.categories.models.category'));
};
