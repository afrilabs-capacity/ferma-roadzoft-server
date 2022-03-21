<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_reports', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->integer('user_id');
            $table->string('nos')->nullable();
            $table->dateTime('submitted')->nullable();
            $table->string('geo_zone')->nullable();
            $table->integer('state')->nullable();
            $table->integer('lga')->nullable();
            $table->string('rsc')->nullable();
            $table->boolean('sos')->nullable();
            $table->string('location')->nullable();
            $table->string('nfsos')->nullable();
            $table->integer('nwos')->nullable();
            $table->string('now')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('npw')->nullable();
            $table->boolean('gtw')->nullable();
            $table->boolean('eqw')->nullable();
            $table->string('wgatm')->nullable();
            $table->integer('envsor')->nullable();
            $table->string('or')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('supervisor_reports');
    }
}
