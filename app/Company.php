<?php

namespace App;

use App\Job;
use App\City;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name','city_id'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
