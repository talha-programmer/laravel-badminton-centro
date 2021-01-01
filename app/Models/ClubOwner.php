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
}
