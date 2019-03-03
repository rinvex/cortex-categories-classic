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
        $abilities = [
            ['name' => 'list', 'title' => 'List categories', 'entity_type' => 'category'],
            ['name' => 'import', 'title' => 'Import categories', 'entity_type' => 'category'],
            ['name' => 'create', 'title' => 'Create categories', 'entity_type' => 'category'],
            ['name' => 'update', 'title' => 'Update categories', 'entity_type' => 'category'],
            ['name' => 'delete', 'title' => 'Delete categories', 'entity_type' => 'category'],
            ['name' => 'audit', 'title' => 'Audit categories', 'entity_type' => 'category'],
        ];

        collect($abilities)->each(function (array $ability) {
            app('cortex.auth.ability')->create($ability);
        });
    }
}
