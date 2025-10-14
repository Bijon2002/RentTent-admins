<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verification Status</title>
</head>
<body>
    <h2>Hello,</h2>
    <p>Your profile verification status is: <strong>{{ $status }}</strong>.</p>

    @if($status == 'Rejected')
        <p>Reason: {{ $reason ?? 'Unclear image provided' }}</p>
        <p>Please upload a clearer image and try again.</p>
    @endif

    <br>
    <p>Thanks,<br>RentTent Admin Team</p>
</body>
</html>
