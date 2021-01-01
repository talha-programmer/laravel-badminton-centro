<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    protected $table = 'users_directors';

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
