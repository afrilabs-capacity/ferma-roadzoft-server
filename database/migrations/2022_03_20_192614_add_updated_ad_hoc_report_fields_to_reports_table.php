<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedAdHocReportFieldsToReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            //
            $table->string('geo_zone')->nullable();
            $table->string('rsc')->nullable();
            $table->boolean('sos')->nullable();
            $table->string('nfsos')->nullable();
            $table->integer('nwos')->nullable();
            $table->string('now')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('npw')->nullable();
            $table->boolean('gtw')->nullable();
            $table->boolean('eqw')->nullable();
            $table->string('wgatm')->nullable();
            $table->integer('envsor')->nullable();
            $table->string('review')->nullable();
            $table->string('stateroad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            //
            $table->dropColumn('geo_zone');
            $table->dropColumn('rsc');
            $table->dropColumn('sos');
            $table->dropColumn('nfsos');
            $table->dropColumn('nwos');
            $table->dropColumn('now');
            $table->dropColumn('rating');
            $table->dropColumn('npw');
            $table->dropColumn('gtw');
            $table->dropColumn('eqw');
            $table->dropColumn('wgatm');
            $table->dropColumn('envsor');
            $table->dropColumn('review');
            $table->dropColumn('stateroad');
        });
    }
}
