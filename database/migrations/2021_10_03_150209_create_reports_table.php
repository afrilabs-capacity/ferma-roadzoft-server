<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('message')->nullable();
            $table->longText('photo_1')->nullable();
            $table->longText('photo_2')->nullable();
            $table->longText('photo_3')->nullable();
            $table->longText('photo_4')->nullable();
            $table->string('longitude');
            $table->string('latitude');
            $table->string('status');
            $table->integer('project_id');
            $table->integer('user_id');
            $table->dateTime('posted')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('reports');
    }
}
