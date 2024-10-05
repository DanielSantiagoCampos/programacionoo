<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatGPTService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');

        if (!$this->apiKey) {
            throw new \Exception('Falta la clave API de OpenAI.');
        }
    }

    public function sendMessage($message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 150,
            ]);

            if ($response->failed()) {
                throw new \Exception('Error en la solicitud a OpenAI: ' . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            // Manejo de errores
            return ['error' => $e->getMessage()];
        }
    }
}