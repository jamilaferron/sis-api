<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'session_type', 'start_date', 'end_date', 'start_time', 'end_time',
    ];
}
