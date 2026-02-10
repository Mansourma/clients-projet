<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Service Unavailable</title>
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
        .loader {
            border: 5px solid #000;
            border-top: 5px solid #d3ac47;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <svg class="logo" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="45" fill="#d3ac47"/>
            <text x="50" y="62" font-size="40" text-anchor="middle" fill="#000">503</text>
        </svg>
        <h1>We'll be back soon!</h1>
        <p>Sorry for the inconvenience. We're performing some maintenance at the moment.</p>
        <p>Please check back in a little while.</p>
        <div class="loader"></div>
        <a href="javascript:location.reload();" class="btn">Refresh Page</a>
    </div>
</body>
</html>
