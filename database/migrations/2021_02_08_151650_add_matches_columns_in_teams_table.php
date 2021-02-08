<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatchesColumnsInTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('total_matches')->nullable();
            $table->integer('won_matches')->nullable();
            $table->integer('lost_matches')->nullable();
            $table->integer('tied_matches')->nullable();
            $table->float('ranking')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('total_matches');
            $table->dropColumn('won_matches');
            $table->dropColumn('lost_matches');
            $table->dropColumn('tied_matches');
            $table->dropColumn('ranking');

        });
    }
}
