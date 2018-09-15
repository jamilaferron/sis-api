<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Address extends Model
{
    //
    public function supportWorker()
    {
        return $this->belongsTo('App\SupportWorker');
    }

    public function serviceUsers()
    {
        return $this->hasMany('App\ServiceUser');
    }

    public function socialWorkers()
    {
        return $this->hasMany('App\SocialWorker');
    }

    public function sessions()
    {
        return $this->hasMany('App\SupportSessions');
    }

    public function addressCheck($address_type, $line1, $line2, $town, $county, $postal_code)
    {
        if(!empty($address_type) && !empty($line1) && !empty($town) && !empty($county) && !empty($postal_code))
        {
            $stmt = DB::select('select * from addresses where address_type = $address_type AND line1 = $line1 AND town = $town AND county = $county AND postal_code = $postal_code');
            $rows = DB::fetch();
        }
    }
}
