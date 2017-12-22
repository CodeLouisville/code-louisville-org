<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class CreateSeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeds:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create DB seeds for local dev environment';

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
        $host = env('DB_HOST');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');

        $getContent = new Process("mysqldump -h $host -u $user -p$pass codelouisville content > storage/app/laravel-db-seeds/content.sql");
        $getContent->run();
        $getGrads = new Process("mysqldump -h $host -u $user -p$pass codelouisville grads > storage/app/laravel-db-seeds/grads.sql");
        $getGrads->run();
        $getMentors = new Process("mysqldump -h $host -u $user -p$pass codelouisville mentors > storage/app/laravel-db-seeds/mentors.sql");
        $getMentors->run();

        $this->info('Database seeds created!');
    }
}
