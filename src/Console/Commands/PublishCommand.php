<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Console\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:publish:categorizable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Cortex Categorizable Resources.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->warn('Publish cortex/categorizable:');
        $this->call('vendor:publish', ['--tag' => 'rinvex-categorizable-config']);
        $this->call('vendor:publish', ['--tag' => 'cortex-categorizable-views']);
        $this->call('vendor:publish', ['--tag' => 'cortex-categorizable-lang']);
    }
}
