<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function notifer()
    {
        return $this->belongsTo('App\User', 'notifer_id');
    }

}
