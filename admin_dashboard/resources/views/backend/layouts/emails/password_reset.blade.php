<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e0f7fa;
            color: #004d40;
        }
        .container {
            width: 500px;
            margin: 100px auto;
            padding: 25px;
            background-color: #ffffff;
            border: 2px solid #004d40;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #00796b;
        }
        p {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .otp {
            text-align: center;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #d32f2f;
        }
        hr {
            border: 0;
            height: 1px;
            background: #004d40;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            OTP Verification
        </div> 
        <hr>
        <p>Hello,</p>
        <p>You have requested a password reset. Please use the following 6-digit OTP to reset your password:</p>
        <p class="otp">{{ $token }}</p>
        <p>This OTP will expire in 5 minutes. If you did not request a password reset, please ignore this email.</p>
    </div>
</body>
</html>

