<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumeRequest;
use App\Http\Requests\UpdateResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {

        try {
            $resumes = Resume::all();
            return $this->customeResponse(ResumeResource::collection($resumes),"All Resumes",200);

        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There is a problem with Resume",500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResumeRequest $request)
    {
        try {
            $resume = Resume::create([
                'to_date' => $request->to_date,
                'from_date' =>$request->from_date,
                'description' => $request->description,
                'institute' => $request->institute,
            ]);
            return $this->customeResponse(new ResumeResource($resume), 'Resume Created Successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error , Resume did not Create ",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Resume $resume)
    {
        try {
            return $this->customeResponse(new ResumeResource($resume), 'show is Done ', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There is problem in show",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResumeRequest $request, Resume $resume)
    {
        try {
            $resume->to_date= $request->input('to_date') ?? $resume->to_date;
            $resume->from_date= $request->input('from_date') ?? $resume->from_date;
            $resume->description= $request->input('description') ?? $resume->description;
            $resume->institute= $request->input('institute') ?? $resume->institute;
            $resume->save();
            return $this->customeResponse(new ResumeResource($resume), 'Update is Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There is problem in update",500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume)
    {
        try {
            $resume->delete();
            return $this->customeResponse("", ' deleted  resume successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There is a problem in delete",500);
        }

    }
}
