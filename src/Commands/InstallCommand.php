<?php

namespace Kolirt\Transformer\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transformer:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install transformer package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('vendor:publish', ['--provider' => 'Kolirt\\Transformer\\ServiceProvider']);
    }
}
