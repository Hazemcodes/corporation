<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Country;

class CountryController extends Controller
{
    public function index()
    {
        $country = Country::paginate();
        
        return $country;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries,name',
        ]);

        $inputs = $request->only('name');
        $country = Country::create($inputs);
        
        return $country;
    }

    public function update(Country $country, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries,name,' . $country->id,
        ]);

        $inputs = $request->only('name');
        $country->update($inputs);
        
        return response()->json(['message' => 'Success']);
    }
    
    public function delete(Country $country)
    {
        $country->delete();
        
        return response()->json(['message' => 'Success']);
    }
}
