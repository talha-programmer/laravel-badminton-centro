<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerMatch extends Model
{
    use HasFactory;
    protected $table = 'player_matches';
    public $timestamps = false;

    protected $fillable = [
        'points',
        'has_won',
    ];



}
