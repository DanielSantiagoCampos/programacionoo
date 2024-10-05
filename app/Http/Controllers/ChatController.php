<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatGPTService;
use App\Models\Message;

class ChatController extends Controller
{
    protected $chatGPT;

    public function __construct(ChatGPTService $chatGPT)
    {
        $this->chatGPT = $chatGPT;
    }

    public function index()
    {
        $messages = Message::all();

        return view('chat.index', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');

        // Guarda el mensaje del usuario
        $message = Message::create(['content' => $userMessage]);

        // Obtén la respuesta de GPT
        $response = $this->chatGPT->sendMessage($userMessage);

        // Guarda el mensaje de GPT
        Message::create(['content' => $response['choices'][0]['message']['content']]);

        return redirect()->back();
    }
}

