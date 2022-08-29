<?php

declare(strict_types=1);

use Diglactic\Breadcrumbs\Generator;
use Cortex\Categories\Models\Category;
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('adminarea.cortex.categories.categories.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.home');
    $breadcrumbs->push(trans('cortex/categories::common.categories'), route('adminarea.cortex.categories.categories.index'));
});

Breadcrumbs::for('adminarea.cortex.categories.categories.import', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(trans('cortex/categories::common.import'), route('adminarea.cortex.categories.categories.import'));
});

Breadcrumbs::for('adminarea.cortex.categories.categories.import.logs', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.import');
    $breadcrumbs->push(trans('cortex/categories::common.logs'), route('adminarea.cortex.categories.categories.import.logs'));
});

Breadcrumbs::for('adminarea.cortex.categories.categories.create', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(trans('cortex/categories::common.create_category'), route('adminarea.cortex.categories.categories.create'));
});

Breadcrumbs::for('adminarea.cortex.categories.categories.edit', function (Generator $breadcrumbs, Category $category) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(strip_tags($category->name), route('adminarea.cortex.categories.categories.edit', ['category' => $category]));
});

Breadcrumbs::for('adminarea.cortex.categories.categories.logs', function (Generator $breadcrumbs, Category $category) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.edit', $category);
    $breadcrumbs->push(trans('cortex/categories::common.logs'), route('adminarea.cortex.categories.categories.logs', ['category' => $category]));
});
