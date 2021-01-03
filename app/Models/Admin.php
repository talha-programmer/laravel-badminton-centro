<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'users_admins';

    /**
     * Creates relationship with User Model
     **/
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
