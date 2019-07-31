<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use App\Country;
use App\User;

class City extends Model
{
    protected $fillable = [
        'name','country_id'
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
