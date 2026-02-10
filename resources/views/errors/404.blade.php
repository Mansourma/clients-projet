<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #d3ac47;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            max-width: 600px;
            padding: 20px;
        }
        h1 {
            font-size: 72px;
            margin-bottom: 0;
        }
        p {
            font-size: 18px;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            background-color: #d3ac47;
            color: #000;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #b18f2e;
        }
        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <svg class="logo" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="45" fill="#d3ac47"/>
            <text x="50" y="62" font-size="40" text-anchor="middle" fill="#000">404</text>
        </svg>
        <h1>Oops!</h1>
        <p>The page you're looking for seems to have vanished into thin air.</p>
        <p>Don't worry, it happens to the best of us.</p>
        <a href="{{ url('home') }}" class="btn">Go Back Home</a>
    </div>
</body>
</html>
