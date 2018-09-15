<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role', 'active', 'picture', 'dbs_num', 'dob', 'address_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function supportWorker()
    {
        return $this->hasOne('App\SupportWorker');
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
}
