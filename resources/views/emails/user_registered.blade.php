<!DOCTYPE html>
<html>
<head>
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
<h1>Welcome, {{ $userName }}!</h1>
<p>Thank you for registering at {{ config('app.name') }}. We're thrilled to have you on board!</p>
<p>If you have any questions or need assistance, feel free to reach out to us.</p>
<p>Best regards,</p>
<p>The {{ config('app.name') }} Team</p>
</body>
</html>
