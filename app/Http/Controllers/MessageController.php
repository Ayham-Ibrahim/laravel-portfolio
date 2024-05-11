<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\UploadFileTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $messages = Message::all();
            return $this->customeResponse(MessageResource::collection($messages),'Done',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        try {
            $message = Message::create([
                'name'       =>$request->name,
                'email'      =>$request->email,
                'subject'    =>$request->subject,
                'body'       =>$request->body,
            ]);
            return $this->customeResponse(new MessageResource($message),'Message created successfully',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        try {
            return $this->customeResponse(new MessageResource($message),'Done',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        try {
        $message->name = $request->input('name') ?? $message->name;
        $message->email = $request->input('email') ?? $message->email;
        $message->subject = $request->input('subject') ?? $message->subject;
        $message->body = $request->input('body') ?? $message->body;
        $message->save();
        return $this->customeResponse(new MessageResource($message),'Message updated successfully',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        try {
            $message->delete();
            return $this->customeResponse(null,'Message deleted successfully',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }
}
