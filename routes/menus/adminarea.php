<?php

declare(strict_types=1);

use Rinvex\Menus\Models\MenuItem;
use Cortex\Categories\Models\Category;
use Rinvex\Menus\Models\MenuGenerator;

Menu::register('adminarea.sidebar', function (MenuGenerator $menu, Category $category) {
    $menu->findByTitleOrAdd(trans('cortex/foundation::common.taxonomy'), 10, 'fa fa-arrows', [], function (MenuItem $dropdown) use ($category) {
        $dropdown->route(['adminarea.categories.index'], trans('cortex/categories::common.categories'), 10, 'fa fa-sitemap')->ifCan('list', $category)->activateOnRoute('adminarea.categories');
    });
});

Menu::register('adminarea.categories.tabs', function (MenuGenerator $menu, Category $category) {
    $menu->route(['adminarea.categories.import'], trans('cortex/categories::common.records'))->ifCan('import', $category)->if(Route::is('adminarea.categories.import*'));
    $menu->route(['adminarea.categories.import.logs'], trans('cortex/categories::common.logs'))->ifCan('import', $category)->if(Route::is('adminarea.categories.import*'));
    $menu->route(['adminarea.categories.create'], trans('cortex/categories::common.details'))->ifCan('create', $category)->if(Route::is('adminarea.categories.create'));
    $menu->route(['adminarea.categories.edit', ['category' => $category]], trans('cortex/categories::common.details'))->ifCan('update', $category)->if($category->exists);
    $menu->route(['adminarea.categories.logs', ['category' => $category]], trans('cortex/categories::common.logs'))->ifCan('audit', $category)->if($category->exists);
});
