<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        try {
            $projects = Cache::remember('projects', now()->addMinutes(60), function () {
                return Project::with('skills')->get();
            });
            return $this->customeResponse(ProjectResource::collection($projects),'Done',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {
            $project->load('skills');
            return $this->customeResponse(new ProjectResource($project), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

}
