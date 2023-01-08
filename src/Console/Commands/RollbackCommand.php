<?php

declare(strict_types=1);

namespace Cortex\Categories\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Rinvex\Categories\Console\Commands\RollbackCommand as BaseRollbackCommand;

#[AsCommand(name: 'cortex:rollback:categories')]
class RollbackCommand extends BaseRollbackCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:rollback:categories {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback Cortex Categories Tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $path = config('cortex.categories.autoload_migrations') ?
            'app/cortex/categories/database/migrations' :
            'database/migrations/cortex/categories';

        if (file_exists($path)) {
            $this->call('migrate:reset', [
                '--path' => $path,
                '--force' => $this->option('force'),
            ]);
        } else {
            $this->warn('No migrations found! Consider publish them first: <fg=green>php artisan cortex:publish:categories</>');
        }

        parent::handle();
    }
}
