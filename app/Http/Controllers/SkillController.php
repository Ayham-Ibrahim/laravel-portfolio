<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\UploadFileTrait;
use App\Http\Resources\SkillResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Cache;


class SkillController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $skills = Cache::remember('skills', now()->addMinutes(120), function () {
                return Skill::all();
            });
            return $this->customeResponse(SkillResource::collection($skills), "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request)
    {
        try {
            $skill = Skill::create([
                'title' => $request->title,
                'avarage' => $request->avarage,
            ]);

            return $this->customeResponse(new SkillResource($skill), 'Skill created successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
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
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        try {
            $skill->title = $request->input('title') ?? $skill->title;
            $skill->avarage = $request->input('avarage') ?? $skill->avarage;
            $skill->save();
            
            return $this->customeResponse(new SkillResource($skill), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        try {
            $skill->delete();
            return $this->customeResponse("", 'Skill deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
}
