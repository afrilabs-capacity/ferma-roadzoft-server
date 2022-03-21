<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorQueryCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_query_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id');
            $table->string('report_uuid')->nullable();
            $table->string('uuid')->nullable();
            $table->integer('user_id');
            $table->string('type');
            $table->longText('comment');
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
        Schema::dropIfExists('supervisor_query_comments');
    }
}
