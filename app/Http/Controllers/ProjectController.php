<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResources;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Log;


class ProjectController extends Controller
{
    use ApiResponseTrait,UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $projects = Project::all();
            return $this->customeResponse(ProjectResource::collection($projects),"Done",200);
            
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try {
            $projects = Project::create([
                'title'  =>$request->title,
                'date'   =>$request->date,
                'description' =>$request->description,
                'image' =>$request->image,
                'link' =>$request->link,
                'github-repo' =>$request->github_repo,
                
            ]);
            if ($request->has('project_id')) {
                $project->projects()->attach($request->input('project_id'));
            }
            return $this->customeResponse(new ProjectResource($projects), 'project Created Successfuly', 200);
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
            return $this->customeResponse(new ProjectResource($project), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        try {
            $project->title= $request->input('title') ?? $project->title;
            $project->date= $request->input('date') ?? $project->date;
            $project->description= $request->input('description') ?? $project->description;
            $project->image= $request->input('image') ?? $project->image;
            $project->link= $request->input('link') ?? $project->link;
            $project->github_repo= $request->input('github_repo') ?? $project->github_repo;
            $project->save();
            if ($request->has('project_id')) {
                $project->projects()->sync($request->input('project_id'));
            }
            return $this->customeResponse(new ProjectResource($project), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->projects()->detach();
            $project->delete();
            return $this->customeResponse("", 'project deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }
}
