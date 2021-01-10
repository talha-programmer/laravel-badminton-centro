<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('users_players');
            $table->foreignId('match_id')->constrained('matches');
            $table->integer('points')->nullable();
            $table->boolean('has_won')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_matches');
    }
}
