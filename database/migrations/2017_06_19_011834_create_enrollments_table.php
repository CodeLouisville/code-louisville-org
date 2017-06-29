<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('enrollments')) {
            Schema::create('enrollments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('firstname')->nullable();
                $table->string('lastname')->nullable();
                $table->string('ssn')->nullable();
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('countycode')->nullable();
                $table->string('zipcode')->nullable();
                $table->string('birthdate')->nullable();
                $table->string('msgphone')->nullable();
                $table->string('email')->nullable();
                $table->string('gender')->nullable();
                $table->string('amerindian')->nullable();
                $table->string('asian')->nullable();
                $table->string('white')->nullable();
                $table->string('black')->nullable();
                $table->string('islander')->nullable();
                $table->string('didnotidentifyrace')->nullable();
                $table->string('hispanic')->nullable();
                $table->string('primarylangeng')->nullable();
                $table->string('primarylangspan')->nullable();
                $table->string('citizenship')->nullable();
                $table->string('veteranstatus')->nullable();
                $table->string('employmentstatus')->nullable();
                $table->string('uistatus')->nullable();
                $table->string('disablingcondition')->nullable();
                $table->string('havefelony')->nullable();
                $table->string('codelouedlevel')->nullable();
                $table->string('employedtech')->nullable();
                $table->string('jobmainduties')->nullable();
                $table->string('interestedtech')->nullable();
                $table->string('jobinterest')->nullable();
                $table->string('codelou_lou')->nullable();
                $table->string('codelou_jeff')->nullable();
                $table->string('codelou_lagrange')->nullable();
                $table->string('selectiveservice')->nullable();
                $table->string('incomelevel')->nullable();
                $table->string('codelouenrolleduniv')->nullable();
                $table->string('codelouwhatunivdegree')->nullable();
                $table->string('codeloucat1dslwrk')->nullable();
                $table->string('codeloucat2dslwrk')->nullable();
                $table->string('codeloucat3dslwrk')->nullable();
                $table->string('codeloucat4dslwrk')->nullable();
                $table->string('codeloucat5dslwrk')->nullable();
                $table->string('codelounumhouse')->nullable();
                $table->string('rectanf')->nullable();
                $table->string('recgeneralasst')->nullable();
                $table->string('recother')->nullable();
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
        Schema::drop('enrollments');
    }
}
