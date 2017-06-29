<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('grads')) {
            Schema::create('grads', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('linked');
                $table->string('github');
                $table->dateTime('cohort_date');
                $table->tinyInteger('front_end');
                $table->tinyInteger('full_stack_js');
                $table->tinyInteger('php');
                $table->tinyInteger('dot_net');
                $table->tinyInteger('rails');
                $table->tinyInteger('ios');
                $table->tinyInteger('android');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grads');
    }
}
