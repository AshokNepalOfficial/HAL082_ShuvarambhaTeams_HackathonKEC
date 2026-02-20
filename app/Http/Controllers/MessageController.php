<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use App\Models\Chatbot;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Chatbot $chatbot, Conversation $conversation)
    {
        // Safety check: ensure conversation belongs to this chatbot
        if ($conversation->chatbot_id !== $chatbot->id) abort(403);
        
        return $conversation->messages;
    }

    public function store(Request $request, Chatbot $chatbot, Conversation $conversation)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        // Store user's message
        $userMessage = Message::create([
            'conversation_id' => $conversation->id,
            'sender' => 'user', // must match allowed ENUM values
            'message' => $request->message,
        ]);

        // Ensure 'assistant' is allowed in ENUM
        // Store AI response in DB
        $aiMessage = Message::create([
            'conversation_id' => $conversation->id,
            'sender' => 'assistant', // must match ENUM('user','assistant')
            'message' => "I am the {$chatbot->name}. You said: {$request->message}",
        ]);

        return response()->json([
            'user_message' => $userMessage,
            'ai_message' => $aiMessage
        ]);
    }
}