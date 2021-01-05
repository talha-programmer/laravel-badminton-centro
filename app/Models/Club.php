<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $table = "clubs";

    protected $fillable = [
      'name',
      'city',
      'address',
    ];

    public function clubOwner()
    {
        return $this->belongsTo(ClubOwner::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'clubs_joined');
    }

}
