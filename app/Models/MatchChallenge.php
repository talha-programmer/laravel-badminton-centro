<?php

namespace App\Models;

use App\Services\RankingServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchChallenge extends Model
{
    use HasFactory;


    public function challengerPlayer()
    {
        return $this->belongsTo(Player::class, 'challenger_player');
    }

    public function challengedPlayer()
    {
        return $this->belongsTo(Player::class, 'challenged_player');
    }



}
