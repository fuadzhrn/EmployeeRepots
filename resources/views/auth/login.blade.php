<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Login - Request Management System</title>
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #007E7A 0%, #005f5a 100%);
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 126, 122, 0.3);
            width: 100%;
            max-width: 420px;
            padding: 40px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
            text-align: center;
        }

        .login-header img {
            width: 80px;
            height: auto;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #007E7A;
            margin: 0;
        }

        .login-header p {
            font-size: 14px;
            color: #7a8896;
            margin: 0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #072033;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(7, 32, 50, 0.08);
            background: #f8f9fa;
            color: #0b2b3a;
            font-size: 14px;
            font-family: "Montserrat", sans-serif;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: #007E7A;
            background: white;
            box-shadow: 0 8px 20px rgba(0, 126, 122, 0.1);
        }

        .form-group input::placeholder {
            color: #9fb0bb;
        }

        .login-button {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(90deg, #007E7A, #005f5a);
            color: white;
            text-align: center; 
            align-items: center;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 12px;
            font-family: "Montserrat", sans-serif;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 126, 122, 0.25);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee;
            border-left: 4px solid #ff6b6b;
            padding: 12px 14px;
            border-radius: 6px;
            color: #c41e3a;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #007E7A;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: #005f5a;
        }

        @media (max-width: 520px) {
            .login-card {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body style="background: #e4e4e4;">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('asset/logo_putihvale.png') }}" alt="Logo">
                <div>
                    <h1>Login</h1>
                    <p>Request Management System</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first('message') ?? 'Username atau password salah' }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required autofocus value="{{ old('username') }}">
                    @error('username')
                        <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                    @error('password')
                        <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="login-button">Login</button>
            </form>

            <div class="back-link">
                <a href="{{ route('welcome') }}">← Kembali ke Home</a>
            </div>
        </div>
    </div>
</body>
</html>
