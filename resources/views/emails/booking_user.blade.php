<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Notification</title>
</head>
<body>
    <h2>Hello {{ $booking->user->name }},</h2>

    <p>You have {{ $booking->status }}:</p>

    <ul>
        <li><strong>Boarding:</strong> {{ $booking->boarding->title }}</li>
        <li><strong>Location:</strong> {{ $booking->boarding->location }}</li>
        <li><strong>Provider:</strong> {{ $booking->boarding->provider->name }}</li>
        <li><strong>Phone:</strong> {{ $booking->boarding->provider->phone }}</li>
        <li><strong>Email:</strong> {{ $booking->boarding->provider->email }}</li>
        <li><strong>Paid:</strong> Rs. {{ $booking->amount }}</li>
    </ul>

    <p>Thank you for using our service!</p>
</body>
</html>
