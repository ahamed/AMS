<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('building_id');
            $table->string('institute');
            $table->string('operator_id');
            $table->string('visitor_id');
            $table->string('member_id');
            $table->string('reference');
            $table->string('agendas');
            $table->timestamp('starts')->nullable();
            $table->timestamp('ends')->nullable();
            $table->string('statuses');
            $table->boolean('flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
