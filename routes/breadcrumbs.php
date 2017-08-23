<?php

declare(strict_types=1);

use Rinvex\Categorizable\Contracts\CategoryContract;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::register('backend.categories.index', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->push('<i class="fa fa-dashboard"></i> '.trans('cortex/foundation::common.backend'), route('backend.home'));
    $breadcrumbs->push(trans('cortex/categorizable::common.categories'), route('backend.categories.index'));
});

Breadcrumbs::register('backend.categories.create', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('backend.categories.index');
    $breadcrumbs->push(trans('cortex/categorizable::common.create_category'), route('backend.categories.create'));
});

Breadcrumbs::register('backend.categories.edit', function (BreadcrumbsGenerator $breadcrumbs, CategoryContract $category) {
    $breadcrumbs->parent('backend.categories.index');
    $breadcrumbs->push($category->name, route('backend.categories.edit', ['category' => $category]));
});

Breadcrumbs::register('backend.categories.logs', function (BreadcrumbsGenerator $breadcrumbs, CategoryContract $category) {
    $breadcrumbs->parent('backend.categories.index');
    $breadcrumbs->push($category->name, route('backend.categories.edit', ['category' => $category]));
    $breadcrumbs->push(trans('cortex/categorizable::common.logs'), route('backend.categories.logs', ['category' => $category]));
});
