<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content','user_id','spot_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function spot()
    {
        return $this->belongsTo('App\Spot');
    }
}
