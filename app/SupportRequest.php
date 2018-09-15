<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    protected $casts = [
        'request_days' => 'array'
    ];
    //
    public function serviceUser()
    {
        return $this->belongsTo('App\ServiceUser');
    }
}
