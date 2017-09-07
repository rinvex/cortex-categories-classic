<?php

declare(strict_types=1);

Menu::adminareaSidebar('taxonomies')->routeIfCan('list-categories', 'adminarea.categories.index', '<i class="fa fa-sitemap"></i> <span>'.trans('cortex/categorizable::common.categories').'</span>');
