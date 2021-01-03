<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $table = 'users_players';

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}