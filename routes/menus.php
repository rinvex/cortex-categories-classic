<?php

declare(strict_types=1);

Menu::backendSidebar('taxonomies')->routeIfCan('list-categories', 'backend.categories.index', '<i class="fa fa-sitemap"></i> <span>'.trans('cortex/categorizable::common.categories').'</span>');
