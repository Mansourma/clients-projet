<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des clients')</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('/storage/images/logo.png') }}" type="image/x-icon">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }


        .navbar {
            width: calc(100% - 200px);
            background-color: #000;
            padding: 0.5rem 1rem;
            color: #D3AC47;
            position: fixed;
            top: 0;
            left: 200px;
            z-index: 1000;
        }

        .main-content {
            margin-top: 10px;
            margin-left: 200px;
            padding: 1rem;
            height: calc(100vh - 60px);
            position: relative;
            overflow-y: auto;
        }



    </style>
</head>

<body>
    <div class="sidebar">
        @include('layouts.sidebar')
    </div>
    <div class="navbar">
        @include('layouts.nav')
    </div>
    <div class="main-content">
        <div class="main">
            @yield('main')
        </div>
    </div>




    <!-- Bootstrap JS and dependencies -->
    @include('partials.sweetalert')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>
