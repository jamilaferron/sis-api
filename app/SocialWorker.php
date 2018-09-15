<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialWorker extends Model
{
    //
    public function serviceUsers()
    {
        return $this->hasMany('App\ServiceUser');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}
