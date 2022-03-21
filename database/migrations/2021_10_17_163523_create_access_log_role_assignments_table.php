<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessLogRoleAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_log_role_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->string('description');
            $table->integer('user_id');
            $table->integer('access_log_id');
            $table->integer('affected_role_model_id');
            $table->integer('affected_user_model_id');
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
        Schema::dropIfExists('access_log_role_assignments');
    }
}
