<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->paginate(10);
        return MessageResource::collection($messages);
    }

    public function store(StoreMessageRequest $request)
    {
        $message = Message::create($request->validated());
        $message->load('user');
        return MessageResource::make($message);
    }

    public function show(Message $message)
    {
        $message->load('user');
        return MessageResource::make($message);
    }

    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->validated());
        $message->load('user');
        return MessageResource::make($message);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}
