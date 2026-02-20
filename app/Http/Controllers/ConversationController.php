<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Chatbot;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index(Chatbot $chatbot)
    {
        return Conversation::with(['messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->where('chatbot_id', $chatbot->id)
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    public function store(Chatbot $chatbot)
    {
        $conversation = Conversation::create([
            'chatbot_id' => $chatbot->id,
            'user_type' => 'user',
            'user_id' => Auth::id(),
        ]);

        return response()->json($conversation);
    }
}