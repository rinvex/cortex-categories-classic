<?php

declare(strict_types=1);

use Rinvex\Menus\Models\MenuItem;
use Rinvex\Menus\Factories\MenuFactory;

Menu::modify('adminarea.sidebar', function (MenuFactory $menu) {
    $menu->findByTitleOrAdd(trans('cortex/foundation::common.taxonomy'), 10, 'fa fa-arrows', [], function (MenuItem $dropdown) {
        $dropdown->route(['adminarea.categories.index'], trans('cortex/categories::common.categories'), 10, 'fa fa-sitemap')->ifCan('list-categories')->activateOnRoute('adminarea.categories');
    });
});
