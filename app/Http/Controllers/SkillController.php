<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Resources\SkillResources;
use App\Http\Requests\SkillRequest;
use Illuminate\Support\Facades\Log;


class SkillController extends Controller
{
    use ApiResponseTrait,UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $skills = Skill::all();
            return $this->customeResponse(SkillResource::collection($skills),"Done",200);
            
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request)
    {
        try {
            $skills = Skill::create([
                'title'  =>$request->title,
                'average'   =>$request->average,
                
            ]);
            if ($request->has('project_id')) {
                $skill->projects()->attach($request->input('project_id'));
            }
            return $this->customeResponse(new SkillResource($skills), 'skill Created Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        try {
            return $this->customeResponse(new SkillResource($skill), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        try {
            $skill->title= $request->input('title') ?? $skill->title;
            $skill->average= $request->input('average') ?? $skill->average;
            $skill->save();
            if ($request->has('project_id')) {
                $skill->projects()->sync($request->input('project_id'));
            }
            return $this->customeResponse(new SkillResource($skill), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        try {
            $skill->projects()->detach();
            $skill->delete();
            return $this->customeResponse("", 'skill deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }
}
