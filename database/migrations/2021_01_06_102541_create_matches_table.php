<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('venue');
            $table->foreignId('team_one')->constrained('teams');
            $table->foreignId('team_two')->constrained('teams');
            $table->timestamp('match_time')->useCurrent();
            $table->float('team_one_points')->nullable();
            $table->float('team_two_points')->nullable();
            $table->integer('winner_team')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
