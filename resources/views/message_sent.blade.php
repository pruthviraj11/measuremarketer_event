// In resources/views/emails/message_sent.blade.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body>
    <h2>{{ $subject }}</h2>
    <p>Dear,</p>
    <p>{{ $message }}</p>
    <p>Best regards,</p>
    <p>{{ $sent_by }}</p>
</body>
</html>
