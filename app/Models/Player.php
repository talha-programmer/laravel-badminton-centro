<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $table = 'users_players';
    protected $fillable = [
        'club_ranking',
        'team_ranking',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'teams_joined');
    }

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'clubs_joined');
    }
}
