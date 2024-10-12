<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Stock;  // Importar el modelo Stock

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
        // 1. Consultar la base de datos para obtener los datos que quieres usar
        $stocks = Stock::all();  // Consulta todos los datos de la tabla 'stocks'

        // 2. Crear un formato adecuado de los datos de la tabla para enviarlos a OpenAI
        $stocksContext = $this->formatearDatos($stocks);

        // 3. Incluir los datos de la tabla en el mensaje que se envía a OpenAI
        $messageWithContext = $message . "\n\n" . "Datos relevantes de la tabla Stock:\n" . $stocksContext;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $messageWithContext],
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

    // Función auxiliar para formatear los datos de la tabla 'stocks' de forma legible
    protected function formatearDatos($stocks)
    {
        $contexto = 'Responde solo en base a la siguiente informacion sobre los libros en stock y en caso contrario retorna que no tienes informacion: ';
        foreach ($stocks as $stock) {
            $contexto .= "ID: " . $stock->id . ", Nombre: " . $stock->name . ", Editorial: " . $stock->editorial . 
                         ", Autor: " . $stock->author . ", Precio: $" . $stock->price . ", Cantidad: " . $stock->quantity . "\n";
        }
        return $contexto;
    }
}
