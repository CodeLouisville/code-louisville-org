<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch DB seeds, run migrations, and seed DB in one fell swoop';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('seeds:get');
        $this->callSilent('migrate:refresh');
        $this->info('Database migrations refreshed!');
        $this->callSilent('db:seed');
        $this->info('Database seeded!');
    }
}
