<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
<h1>Booking Confirmation</h1>
<p>Hi {{ $booking->user->name }},</p>

<p>Thank you for booking the event <strong>{{ $booking->event->name }}</strong>!</p>

<p>Here are your booking details:</p>
<ul>
    <li><strong>Event:</strong> {{ $booking->event->name }}</li>
    <li><strong>Date:</strong> {{ $booking->event->date_time }}</li>
    <li><strong>Location:</strong> {{ $booking->event->location }}</li>
    <li><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</li>
</ul>

<p>We look forward to seeing you at the event!</p>

<p>Thanks,<br>The {{ config('app.name') }} Team</p>
</body>
</html>
