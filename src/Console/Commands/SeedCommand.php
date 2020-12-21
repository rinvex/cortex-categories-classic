<?php

declare(strict_types=1);

namespace Cortex\Categories\Console\Commands;

use Illuminate\Console\Command;
use Cortex\Categories\Database\Seeders\CortexCategoriesSeeder;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:seed:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Cortex Categories Data.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->alert($this->description);

        $this->call('db:seed', ['--class' => CortexCategoriesSeeder::class]);

        $this->line('');
    }
}
