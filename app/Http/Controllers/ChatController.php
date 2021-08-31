<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms(Request $request) 
    {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId)
    {
        return ChatMessage::where('chat_room_id', $roomId)
                    ->with('user')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    public function newMessage(Request $request, $roomId)
    {
        
        $newMessage = new ChatMessage();
        // $newMessage->chat_room_id = $roomId;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = 1;
        $newMessage->message = $request->message;
        $newMessage->save();

        return $newMessage;  

    }



}
