<!DOCTYPE html>
<html>
<head>
    <title>Chat con GPT</title>
</head>
<body>
    <form action="/chat" method="POST">
        @csrf
        <input type="text" name="message" placeholder="Escribe tu mensaje aquí..." required>
        <button type="submit">Enviar</button>
    </form>

    <div>
        <h2>Conversación</h2>
        @foreach ($messages as $message)
            <p>{{ $message->content }}</p>
        @endforeach
    </div>
</body>
</html>
