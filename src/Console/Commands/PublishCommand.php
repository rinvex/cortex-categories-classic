<?php

declare(strict_types=1);

namespace Cortex\Categories\Console\Commands;

use Rinvex\Categories\Console\Commands\PublishCommand as BasePublishCommand;

class PublishCommand extends BasePublishCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:publish:categories {--force : Overwrite any existing files.}';

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
        parent::handle();

        $this->call('vendor:publish', ['--tag' => 'cortex-categories-views', '--force' => $this->option('force')]);
        $this->call('vendor:publish', ['--tag' => 'cortex-categories-lang', '--force' => $this->option('force')]);
    }
}
