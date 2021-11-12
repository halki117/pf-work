<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $casts = [
        'image' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

