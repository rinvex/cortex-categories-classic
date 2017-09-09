<?php

declare(strict_types=1);

namespace Cortex\Categories\Console\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:publish:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Cortex Categories Resources.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->warn('Publish cortex/categories:');
        $this->call('vendor:publish', ['--tag' => 'rinvex-categories-config']);
        $this->call('vendor:publish', ['--tag' => 'cortex-categories-views']);
        $this->call('vendor:publish', ['--tag' => 'cortex-categories-lang']);
    }
}
