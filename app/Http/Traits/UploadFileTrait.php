<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait UploadFileTrait
{
    public function uploadFile(Request $request, $folderName, $fileName, $disk){
        $file = $request->file($fileName)->getClientOriginalName();
        $path = $request->file($fileName)->storeAs($folderName,$file,$disk);
        return $path;
    }
}


