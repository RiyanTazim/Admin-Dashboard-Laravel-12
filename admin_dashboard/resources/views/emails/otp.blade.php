<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h2>Hello!</h2>

    <p>Your OTP for resetting password is:</p>

    <h1 style="letter-spacing: 5px; font-size: 32px; color: #333;">
        {{ $otp }}
    </h1>

    <p>This OTP will expire in 5 minutes.</p>

    <p>If you did not request this, please ignore this email.</p>

    <br>
    <p>Thanks,<br>
    {{ config('app.name') }}</p>
</body>
</html>
