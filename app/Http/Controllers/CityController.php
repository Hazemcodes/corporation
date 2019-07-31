<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;
use App\Country;

class CityController extends Controller
{
    public function index()
    {
        $users = City::paginate();
        
        return $users;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'country_id' => 'required|numeric|exists:countries,id',
            'name' => 'required|unique:cities,name,NULL,id,country_id,' . $request->country_id,
        ]);

        $inputs = $request->only('name', 'country_id');
        $city = City::create($inputs);
        
        return $city;
    }

    public function update(City $city, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'country_id' => 'required|numeric|exists:countries,id'
        ]);

        $inputs = $request->only('name', 'country_id');
        
        $city->update($inputs);
        
        return response()->json(['message' => 'Success']);
    }
    
    public function delete(City $city)
    {
        $city->delete();
        
        return response()->json(['message' => 'Success']);
    }
}
