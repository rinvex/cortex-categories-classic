<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:install:categorizable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Cortex Categorizable Module.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->warn('Install cortex/categorizable:');
        $this->call('cortex:migrate:categorizable');
        $this->call('cortex:seed:categorizable');
        $this->call('cortex:publish:categorizable');
    }
}
