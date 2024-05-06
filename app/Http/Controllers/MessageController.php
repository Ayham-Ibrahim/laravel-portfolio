<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MessageController extends Controller
{
    use ApiResponseTrait,UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $messages = Message::all();
            return response()->json(
                [
                    'status' => 'success',
                    'messages'=> $messages
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(
                [
                    'status' => 'failed',
                ]

            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'body' => 'required|string',
            ]);
            $message = Message::create($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => $message
            ], 201);
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

            return response()->json(
                [
                    'status'=>'success',
                    'message'=>$message
                ]
            );
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
            return response()->json([
                'status' => 'success',
                'message' => 'Message deleted successfully'
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error, There somthing Rong here",500);
        }
    }
}
