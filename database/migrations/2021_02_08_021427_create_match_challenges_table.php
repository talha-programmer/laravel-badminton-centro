<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_challenges', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('status');
            $table->foreignId('challenger_player')->constrained('users_players')->onDelete('cascade');
            $table->foreignId('challenged_player')->constrained('users_players')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_challenges');
    }
}
