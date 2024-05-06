<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserInfoRequest;
use App\Http\Requests\UserInfoRequest;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\UploadFileTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\UserInfoResource;
use GuzzleHttp\Promise\Create;

class UserInfoController extends Controller
{
    use ApiResponseTrait,UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     try {
            
    //     } catch (\Throwable $th) {
    //         Log::error($th);
    //         return $this->customeResponse(null,"Error, There somthing Rong here",500);
    //     }
    // }
    // 

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserInfoRequest $request)
    {
        try {
            $first_image_path = $this->UploadFile($request,'images','first_image','porto-images');
            $second_image_path = $this->UploadFile($request,'images','second_image','porto-images');
            $file_path = $this->UploadFile($request,'cv','cv','porto-files');
            $userInfo = UserInfo::Create([
                'name'         => $request->name,
                'phone_number' => $request->phone_number,
                'birth_date'   => $request->birth_date,
                'country'      => $request->country,
                'city'         => $request->city,
                'address'      => $request->address,
                'website'      => $request->website,
                'job_title'    => $request->job_title,
                'first_image'  => $first_image_path,
                'second_image' => $second_image_path,
                'cv'           => $file_path,
            ]);
            return $this->customeResponse(new UserInfoResource($userInfo),"UserInfo created successfully",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserInfo $userInfo)
    {
        try {
            return $this->customeResponse(new UserInfoResource($userInfo),"Done",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserInfoRequest $request, UserInfo $userInfo)
    {
        try {
            $first_image = $this->FileExists($request,$request->first_image,'first_image','images','porto-images', false, $userInfo);
            $second_image = $this->FileExists($request,$request->second_image,'second_image','images','porto-images', false, $userInfo);
            $cv = $this->FileExists($request,$request->cv,'cv','cv','porto-files', false, $userInfo);
            $userInfo->name = $request->input('name') ?? $userInfo->name;
            $userInfo->phone_number = $request->input('phone_number') ?? $userInfo->phone_number;
            $userInfo->birth_date = $request->input('birth_date') ?? $userInfo->birth_date;
            $userInfo->country = $request->input('country') ?? $userInfo->country;
            $userInfo->city = $request->input('city') ?? $userInfo->city;
            $userInfo->address = $request->input('address') ?? $userInfo->address;
            $userInfo->website = $request->input('website') ?? $userInfo->website;
            $userInfo->job_title = $request->input('job_title') ?? $userInfo->job_title;
            $userInfo->first_image = $first_image;
            $userInfo->second_image = $second_image;
            $userInfo->cv = $cv;
            $userInfo->save();
            return $this->customeResponse(new UserInfoResource($userInfo),"UserInfo updated successfully",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInfo $userInfo)
    {
        try {
            $userInfo->delete();
            return $this->customeResponse(null,"userInfo deleted successfully",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }
}
