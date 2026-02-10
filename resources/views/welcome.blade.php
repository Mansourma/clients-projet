<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .login-card {
        display: flex;
        max-width: 900px;
        width: 100%;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-form {
        padding: 2rem;
        background: #fff;
        width: 50%;
    }

    .login-form img {
        max-width: 100px;
        margin-bottom: 1rem;
    }

    .login-form .form-group {
        margin-bottom: 1rem;
    }

    .login-form button {
        width: 100%;
    }

    .login-image {
        width: 50%;
        background: url('background-image.png') no-repeat center center;
        background-size: cover;
    }

    @media (max-width: 767px) {
        .login-card {
            flex-direction: column;
        }

        .login-form,
        .login-image {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-card">
            <div class="login-form">
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/images/rydlogo.png') }}" width="200px" height="100px" alt="client.jpg">
                    <h3>Login</h3>
                </div>
                <form>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="login-image">
                <img src="{{ asset('storage/images/client.jpg') }}" width="500px" height="500px" alt="client.jpg">

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>