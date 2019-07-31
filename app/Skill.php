<?php

namespace App;

use App\Job;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    
    protected $fillable = [
       'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'skill_job');
    }
}
