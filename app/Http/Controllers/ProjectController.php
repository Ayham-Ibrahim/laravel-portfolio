<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\UploadFileTrait;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    use ApiResponseTrait,UploadFileTrait;
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

    public function store(ProjectRequest $request)
    {
        try {
            $project_image_path = $this->UploadFile($request,'images','image','porto-images');
            $project = Project::create([
                'title'  =>$request->title,
                'date'   =>$request->date,
                'description' =>$request->description,
                'image' =>$project_image_path,
                'link' =>$request->link,
                'github_repo' =>$request->github_repo,
                
            ]);
            if ($request->has('skill_id')) {
                $project->skills()->attach($request->input('skill_id'));
            }
            return $this->customeResponse(new ProjectResource($project), 'project Created Successfuly', 200);
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

        /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            $project_image_path = $this->FileExists($request,$request->image,'image','images','porto-images', false, $project);
            $project->title= $request->input('title') ?? $project->title;
            $project->date= $request->input('date') ?? $project->date;
            $project->description= $request->input('description') ?? $project->description;
            $project->image= $project_image_path;
            $project->link= $request->input('link') ?? $project->link;
            $project->github_repo= $request->input('github_repo') ?? $project->github_repo;
            $project->save();
            if ($request->has('skill_id')) {
                $project->skills()->sync($request->input('skill_id'));
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
            $project->delete();
            return $this->customeResponse("", 'project deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

}
