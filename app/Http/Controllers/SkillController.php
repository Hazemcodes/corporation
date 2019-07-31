<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skill = Skill::paginate();

        return $skill;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:skills,name'
        ]);

        $inputs = $request->only('name');
        $skill = Skill::create($inputs);

        return $skill;
    }

    public function update(Skill $skill, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:skills,name' . $skill->id 
        ]);

        $inputs = $request->only('name');
        
        $skill->update($inputs);
        
        return response()->json(['message' => 'Success']);
    }
    
    public function delete(Skill $skill)
    {
        $skill->delete();
        
        return response()->json(['message' => 'Success']);
    }
}
