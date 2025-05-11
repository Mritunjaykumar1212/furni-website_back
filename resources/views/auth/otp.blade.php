<!-- resources/views/auth/otp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
        <div class="email-login-form">
            <h2>Verify OTP</h2>

            <!-- Success or Error Message -->
            @if(session('error'))
                <div class="alert">{{ session('error') }}</div>
            @elseif(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('verify.otp') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="otp" class="form-label"></label>
                    <input type="text" name="otp" id="otp" class="form-input" placeholder="Enter OTP" required>
                </div>
                <button type="submit" class="btn-primary btn-block">Submit OTP</button>
            </form>
        </div>
    </div>
</body>
</html>
