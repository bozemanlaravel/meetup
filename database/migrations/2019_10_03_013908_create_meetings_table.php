<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organizer_id');
            $table->string('name');
            $table->string('description');
            $table->datetime('start');
            $table->datetime('end');
            $table->string('location_name');
            $table->string('location_address');
            $table->string('location_url');

            $table->timestamps();

            $table->foreign('organizer_id')->references('id')->on('users');
        });
    }
}
