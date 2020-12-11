<?php

declare(strict_types=1);

use Cortex\Categories\Models\Category;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::register('adminarea.cortex.categories.categories.index', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->push('<i class="fa fa-dashboard"></i> '.config('app.name'), route('adminarea.home'));
    $breadcrumbs->push(trans('cortex/categories::common.categories'), route('adminarea.cortex.categories.categories.index'));
});

Breadcrumbs::register('adminarea.cortex.categories.categories.import', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(trans('cortex/categories::common.import'), route('adminarea.cortex.categories.categories.import'));
});

Breadcrumbs::register('adminarea.cortex.categories.categories.import.logs', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(trans('cortex/categories::common.import'), route('adminarea.cortex.categories.categories.import'));
    $breadcrumbs->push(trans('cortex/categories::common.logs'), route('adminarea.cortex.categories.categories.import.logs'));
});

Breadcrumbs::register('adminarea.cortex.categories.categories.create', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(trans('cortex/categories::common.create_category'), route('adminarea.cortex.categories.categories.create'));
});

Breadcrumbs::register('adminarea.cortex.categories.categories.edit', function (BreadcrumbsGenerator $breadcrumbs, Category $category) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(strip_tags($category->name), route('adminarea.cortex.categories.categories.edit', ['category' => $category]));
});

Breadcrumbs::register('adminarea.cortex.categories.categories.logs', function (BreadcrumbsGenerator $breadcrumbs, Category $category) {
    $breadcrumbs->parent('adminarea.cortex.categories.categories.index');
    $breadcrumbs->push(strip_tags($category->name), route('adminarea.cortex.categories.categories.edit', ['category' => $category]));
    $breadcrumbs->push(trans('cortex/categories::common.logs'), route('adminarea.cortex.categories.categories.logs', ['category' => $category]));
});
