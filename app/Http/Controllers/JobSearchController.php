<?php

namespace App\Http\Controllers;

use App\User;
use App\Job;
use App\City;
use App\Company;
use App\Country;

use Illuminate\Http\Request;

class JobSearchController extends Controller
{    
    public function best(User $user)
    {
        $jobs = Job::with('company.city.country', 'skills')->get();
        $user->load('skills', 'city.country');

        $jobs = $jobs->map(function ($job, $index) use ($user) {
            $job->points = $this->getPoints($job, $user);

            return $job;
        });

        $jobs = $jobs->sortByDesc('points')->values()->take(3);

        return $jobs;
    }

    private function getPoints(Job $job, User $user)
    {
        $points = 0;

        $points += $this->getSkillPoints($job, $user);
        $points += $this->getLocationPoints($job, $user);
        $points += $this->getSalaryPoints($job, $user);

        return $points;
    }

    public function getSkillPoints(Job $job, User $user)
    {
        $intersection = $job->skills->intersect($user->skills)->count();
        $skillsCount = $job->skills->count();

        if ($skillsCount === 0) {
            return 100;
        }

        return $intersection / $skillsCount * 100;
    }

    public function getLocationPoints(Job $job, User $user)
    {
        if ($job->company->city->id === $user->city->id) {
            return 20;
        } else if ($job->company->city->country->id == $user->city->country->id) {
            return 10;
        } else {
            return 0;
        }
    }

    public function getSalaryPoints(Job $job, User $user)
    {
        return $job->salary / 1000;
    }
}

