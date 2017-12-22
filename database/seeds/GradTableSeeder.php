<?php

use Illuminate\Database\Seeder;

class GradTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get('storage/app/laravel-db-seeds/grads.sql'));
    }
}
