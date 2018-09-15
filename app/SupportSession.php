<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportSession extends Model
{
    //
    protected $fillable = ['supportworker_id','serviceuser_id', 'session_date', 'start_time','end_time'];

    public function Report()
    {
        return $this->belongsTo('App\Report');
    }

    public function supportWorkers()
    {
        return $this->hasMany('App\SupportWorker');
    }

    public function supportRequest()
    {
        return $this->belongsTo('App\SupportRequest');
    }

    public function Addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function supportworker()
    {
        return $this->belongsTo(SupportWorker::class);
    }

    public function serviceuser()
    {
        return $this->belongsTo(ServiceUser::class);
    }
}
