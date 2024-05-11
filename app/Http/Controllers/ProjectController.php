<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ProjectResource;
use App\Http\Traits\ApiResponseTrait;

class ProjectController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        try {
            $porjects = Project::with('skills')->get();
            return $this->customeResponse(ProjectResource::collection($porjects),'Done',200);
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
