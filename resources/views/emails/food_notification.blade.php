<!DOCTYPE html>
<html>
<head>
    <title>Food Package Notification</title>
</head>
<body>
    <h2>🍽️ Food Package Update...!</h2>
    <p><strong>Name:</strong> {{ $foodPackage->name }}</p>
    <p><strong>Type:</strong> {{ ucfirst($foodPackage->food_type) }}</p>
    <p><strong>Preference:</strong> {{ ucfirst($foodPackage->preference) }}</p>
    <p><strong>Monthly Fee:</strong> Rs. {{ number_format($foodPackage->monthly_fee, 2) }}</p>
    <p><strong>Start Date:</strong> {{ $foodPackage->start_date }}</p>
    <p><strong>End Date:</strong> {{ $foodPackage->end_date }}</p>
    <p>Thank you for using RentTent...! 🚀</p>
</body>
</html>
