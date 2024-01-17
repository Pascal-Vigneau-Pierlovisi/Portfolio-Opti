<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact from My Portfolio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Contact Message</h1>
        <p>You have received a new message from your portfolio site:</p>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $data['message'] }}</p>
    </div>
</body>
</html>
