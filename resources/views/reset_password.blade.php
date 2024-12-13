<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>

    {{-- {{ dd($messageop) }} --}}
    {{-- <p><strong>Event ID:</strong> {{ $eventId }}</p> --}}

    @if ($form_type == 'company')
        <p><strong>Dear {{ $contact_person }} Your Login credentials is below :-</strong></p>
    @else
        <p><strong>Dear {{ $fullname }} Your Login credentials is below :-</strong></p>
    @endif

    <p><strong>Login Url :- <a
                href="https://network.optimizexsummit.com">https://network.optimizexsummit.com</a></strong></p>

    <p><strong>Email Address :- {{ $email }}</strong></p>
    <p><strong>New Password :- {{ $randomPassword }}</strong></p>





</body>

</html>
