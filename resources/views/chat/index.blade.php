<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con GPT</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            width: 50%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            width: 100%;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .conversation {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .conversation p {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .conversation p.user-message {
            background-color: #d4edda;
        }

        .conversation p.gpt-message {
            background-color: #f8d7da;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Chat con GPT sobre la informacion de Biblioteca Virtual UCC</h2>
        <form action="/chat" method="POST">
            @csrf
            <input type="text" name="message" placeholder="Escribe tu mensaje aquí..." required>
            <button type="submit">Enviar</button>
        </form>

        <div class="conversation">
            @foreach ($messages as $message)
                <p class="{{ $message->role == 'user' ? 'user-message' : 'gpt-message' }}">
                    {{ $message->content }}
                </p>
            @endforeach
        </div>
    </div>
</body>
</html>
