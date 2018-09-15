<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    protected $casts = [
        'needs' => 'array'
    ];

    protected $table = 'service_users';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function supportSessions()
    {
        return $this->hasMany('App\SupportSession');
    }

    public function supportRequests()
    {
        return $this->hasMany('App\SupportRequest');
    }

    public function socialWorkers()
    {
        return $this->hasMany('App\SocialWorker');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
