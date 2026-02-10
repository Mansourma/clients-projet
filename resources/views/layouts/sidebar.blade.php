<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            display: flex;
        }

        .sidebar {
            background-color: #000;
            color: #D3AC47;
            width: 210px;
            height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar img {
            margin-bottom: 30px;
            width: 150px;
            height: 90px;
        }

        .nav {
            margin-top: 20px;
        }

        .nav-link {
            color: #D3AC47;
            font-size: 18px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #D3AC47;
            color: #000;
        }

        .nav-link.active {
            background-color: #D3AC47;
            color: #000;
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 20px;
        }

        .nav-item + .nav-item {
            margin-top: 10px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #D3AC47;
            text-align: center;
        }

        .sidebar-footer a {
            color: #D3AC47;
            font-size: 16px;
            display: block;
            margin-top: 10px;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home.home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                @if(Auth::user()->role === 'super_admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admins*') ? 'active' : '' }}" href="{{ route('admins.index') }}">
                        <i class="fas fa-address-book"></i> Admins
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('clients*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                        <i class="fas fa-user"></i> Clients
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('services*') ? 'active' : '' }}" href="{{ route('services.index') }}">
                        <i class="fas fa-cogs"></i> Services
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST"><button type="submit" class="btn btn-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    @csrf

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
