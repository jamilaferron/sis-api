<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportWorker extends Model
{
    protected $fillable = ['user_id', 'start_date', 'availability'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
