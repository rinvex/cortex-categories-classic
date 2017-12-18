<?php

declare(strict_types=1);

use Rinvex\Menus\Models\MenuItem;
use Rinvex\Menus\Factories\MenuFactory;

Menu::modify('adminarea.sidebar', function (MenuFactory $menu) {
    $menu->findBy('title', trans('cortex/foundation::common.taxonomy'), function (MenuItem $dropdown) {
        $dropdown->route(['adminarea.categories.index'], trans('cortex/categories::common.categories'), 10, 'fa fa-sitemap')->can('list-categories');
    });
});
