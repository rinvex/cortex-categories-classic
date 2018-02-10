<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class CortexCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('admin')->to('list', config('rinvex.categories.models.category'));
        Bouncer::allow('admin')->to('create', config('rinvex.categories.models.category'));
        Bouncer::allow('admin')->to('update', config('rinvex.categories.models.category'));
        Bouncer::allow('admin')->to('delete', config('rinvex.categories.models.category'));
        Bouncer::allow('admin')->to('audit', config('rinvex.categories.models.category'));
    }
}
