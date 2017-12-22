<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class GetSeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeds:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches DB seeds from production server';

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
        Storage::disk('seeds')->put('content.sql', file_get_contents(env('SEED_URL') . '/content.sql'));
        Storage::disk('seeds')->put('grads.sql', file_get_contents(env('SEED_URL') . '/grads.sql'));
        Storage::disk('seeds')->put('mentors.sql', file_get_contents(env('SEED_URL') . '/mentors.sql'));
        $this->info('Database seeds fetched!');
    }
}
