<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mentors')) {
            Schema::create('mentors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first');
                $table->string('last');
                $table->tinyInteger('active');
                $table->string('linkedin');
                $table->string('github');
                $table->integer('github_id');
                $table->string('twitter');
                $table->string('track');
                $table->string('night');
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
        Schema::drop('mentors');
    }
}
