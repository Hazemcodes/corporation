<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;
use App\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::paginate();
        
        return $company;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'city_id' => 'required|numeric|exists:cities,id',
            'name' => 'required|unique:companies,name'
        ]);

        $inputs = $request->only('name', 'city_id');
        $company = Company::create($inputs);
        
        return $company;
    }

    public function update(Company $company, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city_id' => 'required|numeric|exists:cities,id'
        ]);

        $inputs = $request->only('name', 'city_id');
        
        $company->update($inputs);
        
        return response()->json(['message' => 'Success']);
    }
    
    public function delete(Company $company)
    {
        $company->delete();
        
        return response()->json(['message' => 'Success']);
    }
}
