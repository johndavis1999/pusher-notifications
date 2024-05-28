<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification</title>
</head>
<body>
    <h1>Send Notification</h1>
    <form action="{{ route('send.notification') }}" method="POST">
        @csrf
        <textarea name="titulo" rows="4" cols="50"></textarea>
        <textarea name="message" rows="4" cols="50"></textarea>
        <br>
        <button type="submit">Send</button>
    </form>
</body>
</html>
