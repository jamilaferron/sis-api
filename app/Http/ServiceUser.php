<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dob',
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
