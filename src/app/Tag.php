<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function getHashtagAttribute()
    {
        return '#'.$this->name;
    }

    public function spots()
    {
        return $this->belongsToMany('App\Spot')->withTimestamps();
    }
}
