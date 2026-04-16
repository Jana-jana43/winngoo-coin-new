<!DOCTYPE html>
<html>
<body>
    <h2>Hello {{ $user->name }}</h2>

    <p>Your OTP for email verification is:</p>

    <h1 style="letter-spacing:5px;">{{ $otp }}</h1>

    <p>This OTP is valid for <b>24 hours</b>.</p>

    <p>If you didn’t request this, please ignore this email.</p>

    <br>
    <p>Thanks,<br>Winngoo Coin Team</p>
</body>
</html>