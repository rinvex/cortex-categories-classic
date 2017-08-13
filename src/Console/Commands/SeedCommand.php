<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Console\Commands;

use Illuminate\Console\Command;
use Cortex\Fort\Traits\AbilitySeeder;
use Cortex\Fort\Traits\BaseFortSeeder;
use Illuminate\Support\Facades\Schema;

class SeedCommand extends Command
{
    use AbilitySeeder;
    use BaseFortSeeder;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:seed:categorizable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Default Cortex Categorizable data.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->ensureExistingCategorizableTables()) {
            // No seed data at the moment!
        }

        if ($this->ensureExistingFortTables()) {
            $this->seedAbilities(realpath(__DIR__.'/../../../resources/data/abilities.json'));
        }
    }

    /**
     * Ensure existing categorizable tables.
     *
     * @return bool
     */
    protected function ensureExistingCategorizableTables()
    {
        if (! $this->hasCategorizableTables()) {
            $this->call('cortex:migrate:categorizable');
        }

        return true;
    }

    /**
     * Check if all required categorizable tables exists.
     *
     * @return bool
     */
    protected function hasCategorizableTables()
    {
        return Schema::hasTable(config('rinvex.categorizable.tables.categories'))
               && Schema::hasTable(config('rinvex.categorizable.tables.categorizables'));
    }
}
