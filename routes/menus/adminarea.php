<?php

declare(strict_types=1);

use Rinvex\Menus\Models\MenuItem;
use Cortex\Categories\Models\Category;
use Rinvex\Menus\Models\MenuGenerator;

Menu::register('adminarea.sidebar', function (MenuGenerator $menu, Category $category) {
    $menu->findByTitleOrAdd(trans('cortex/foundation::common.taxonomy'), 10, 'fa fa-arrows', 'header', [], function (MenuItem $dropdown) use ($category) {
        $dropdown->route(['adminarea.cortex.categories.categories.index'], trans('cortex/categories::common.categories'), 10, 'fa fa-sitemap')->ifCan('list', $category)->activateOnRoute('adminarea.cortex.categories.categories');
    });
});

Menu::register('adminarea.cortex.categories.categories.tabs', function (MenuGenerator $menu, Category $category) {
    $menu->route(['adminarea.cortex.categories.categories.import'], trans('cortex/categories::common.records'))->ifCan('import', $category)->if(Route::is('adminarea.cortex.categories.categories.import*'));
    $menu->route(['adminarea.cortex.categories.categories.import.logs'], trans('cortex/categories::common.logs'))->ifCan('import', $category)->if(Route::is('adminarea.cortex.categories.categories.import*'));
    $menu->route(['adminarea.cortex.categories.categories.create'], trans('cortex/categories::common.details'))->ifCan('create', $category)->if(Route::is('adminarea.cortex.categories.categories.create'));
    $menu->route(['adminarea.cortex.categories.categories.edit', ['category' => $category]], trans('cortex/categories::common.details'))->ifCan('update', $category)->if($category->exists);
    $menu->route(['adminarea.cortex.categories.categories.logs', ['category' => $category]], trans('cortex/categories::common.logs'))->ifCan('audit', $category)->if($category->exists);
});
