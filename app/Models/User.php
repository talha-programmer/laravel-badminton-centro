<?php

namespace App\Models;

use App\Enums\UserTypes;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;
    public static $DEFAULT_PROFILE_PIC_URL = 'images/profile-picture.jpg';

    /**
     * Get the url of the sample user image in case if no profile image found
     * */
    public function getProfilePictureUrlAttribute($value){
        if($value == null){
            return User::$DEFAULT_PROFILE_PIC_URL;
        } else{
            return $value;
        }
    }

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::create($value)->format('d/m/Y' );
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'user_type',
        'address',
        'date_of_birth',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * This method will be used to access the model of user type
     * associated with the current User Model. It creates a polymorphic one to one
     * relationship between Models and tables in database
     *
     * Every user type Model has a user() method defined in its Model class
     * which on call return the parent User Model object
     *
     **/
    public function userable()
    {
        return $this->morphTo();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
