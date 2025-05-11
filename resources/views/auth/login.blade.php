<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="email-login-form">
            <h2>Login</h2>
            @if(session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            <form action="{{ route('send.otp') }}" id="email-login-form" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label"></label>
                    <input type="email" class="form-input" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="btn-primary btn-block">Send otp</button>
            </form>
        </div>
    </div>
</body>
</html>
