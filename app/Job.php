<?php

namespace App;

use App\Company;
use App\Skill;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name','company_id', 'salary'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_job');
    }
}
