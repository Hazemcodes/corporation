<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        
        return $users;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city_id' => 'required|unique:cities',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'salary' => 'required|numeric',
        ]);

        $inputs = $request->only('salary', 'name', 'password', 'email', 'city_id');
        $inputs['password'] = bcrypt($inputs['password']);

        $user = User::create($inputs);
        
        return $user;
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city_id' => 'required|numeric|exists:cities,id',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'required|confirmed|min:6',
            'salary' => 'required|numeric',
        ]);

        $inputs = $request->only('salary', 'name', 'password', 'email', 'city_id');
        $inputs['password'] = bcrypt($inputs['password']);

        $user->update($inputs);
        
        return response()->json(['message' => 'Success']);
    }
    
    public function delete(User $user)
    {
        $user->delete();
        
        return response()->json(['message' => 'Success']);
    }
}
