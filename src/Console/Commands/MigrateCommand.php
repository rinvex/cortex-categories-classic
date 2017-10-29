<?php

declare(strict_types=1);

namespace Cortex\Categories\Console\Commands;

use Rinvex\Categories\Console\Commands\MigrateCommand as BaseMigrateCommand;

class MigrateCommand extends BaseMigrateCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:migrate:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Cortex Categories Tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();

        $this->call('migrate', ['--step' => true, '--path' => 'app/cortex/categories/database/migrations']);
    }
}
