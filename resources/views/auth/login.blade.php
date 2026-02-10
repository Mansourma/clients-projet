<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('/storage/images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #d3ac47, #b68c37);
            color: #fff;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left-panel h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .left-panel p {
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .left-panel {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.left-panel h2 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.subtitle {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    color: rgba(255, 255, 255, 0.8);
}

.features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.feature-item i {
    font-size: 1.5rem;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
}

.feature-item span {
    font-size: 1rem;
}

.quote-container {
    margin-top: auto;
    font-style: italic;
    background-color: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 8px;
}



        .right-panel {
            flex: 1;
            padding: 4rem;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo img {
            width: 120px;
        }

        h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-bottom: 2px solid #d3ac47;
            background-color: transparent;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-bottom-color: #b68c37;
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #777;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -10px;
            font-size: 0.8rem;
            color: #b68c37;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        .btn-login {
            background-color: #d3ac47;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #b68c37;
        }

        .alert {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-size: 0.875rem;
            text-align: center;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-panel, .right-panel {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-panel">
            <h2>Welcome Back, Admin</h2>
            <p class="subtitle">Your gateway to exceptional client management</p>
            <div class="features">
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <span>Manage Clients</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-cogs"></i>
                    <span>Control Services</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-wallet"></i>
                    <span>Track Payments</span>
                </div>
            </div>

        </div>
        <div class="right-panel">
            <div class="logo">
                <img src="{{ asset('/storage/images/logo.png') }}" alt="Logo">
            </div>
            <h3>Sign In to Your Account</h3>
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder=" " required autofocus autocomplete="email">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder=" " required autocomplete="password">
                    <label for="password">Password</label>
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="far fa-eye" id="toggleIcon"></i>
                    </span>
                    @error('password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
