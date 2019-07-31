<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;
use App\Job;

class JobController extends Controller
{
    public function index()
    {
        $job = Job::paginate();
        
        return $job;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_id' => 'required|numeric|exists:companies,id',
            'name' => 'required|unique:jobs,name,NULL,id,company_id,' . $request->company_id,
            'salary' => 'required|numeric'
        ]);

        $inputs = $request->only('name', 'company_id', 'salary');
        
        $job = Job::create($inputs);
        
        return $job;
    }

    public function update(Job $job, Request $request)
    {
                $this->validate($request, [
                    'name' => 'required',
                    'company_id' => 'required|numeric|exists:cities,id',
                    'salary' => 'required|numeric'
                ]);

                $inputs = $request->only('name', 'company_id', 'salary');
                
                $job->update($inputs);
                
                return response()->json(['message' => 'Success']);
    }
    
    public function delete(Job $job)
    {
        $job->delete();
        
        return response()->json(['message' => 'Success']);
    }
}