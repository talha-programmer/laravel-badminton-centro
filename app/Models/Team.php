<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function players()
    {
        return $this->belongsToMany(Team::class, 'teams_joined');
    }

}



