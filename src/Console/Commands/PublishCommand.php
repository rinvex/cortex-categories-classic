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
    protected $signature = 'cortex:publish:categories {--force : Overwrite any existing files.} {--R|resource=all}';

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
    public function handle(): void
    {
        parent::handle();

        switch ($this->option('resource')) {
            case 'lang':
                $this->call('vendor:publish', ['--tag' => 'cortex-categories-lang', '--force' => $this->option('force')]);
                break;
            case 'views':
                $this->call('vendor:publish', ['--tag' => 'cortex-categories-views', '--force' => $this->option('force')]);
                break;
            case 'migrations':
                $this->call('vendor:publish', ['--tag' => 'cortex-categories-migrations', '--force' => $this->option('force')]);
                break;
            default:
                $this->call('vendor:publish', ['--tag' => 'cortex-categories-lang', '--force' => $this->option('force')]);
                $this->call('vendor:publish', ['--tag' => 'cortex-categories-views', '--force' => $this->option('force')]);
                $this->call('vendor:publish', ['--tag' => 'cortex-categories-migrations', '--force' => $this->option('force')]);
                break;
        }

        $this->line('');
    }
}
