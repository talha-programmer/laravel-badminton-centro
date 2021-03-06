<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubOwner extends Model
{
    use HasFactory;
    protected $table = 'users_club_owners';

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }

    public function tournaments()
    {
        return $this->hasMany(Tournament::class, 'club_owner_id');
    }

    public function teams()
    {
        return $this->hasManyThrough(Team::class, Club::class);
    }


}
