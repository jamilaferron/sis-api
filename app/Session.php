<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['supportworker_id','serviceuser_id', 'session_date', 'start_time','end_time'];

    public function supportworker()
    {
        return $this->belongsTo(SupportWorker::class);
    }

    public function serviceuser()
    {
        return $this->belongsTo(ServiceUser::class);
    }
}
