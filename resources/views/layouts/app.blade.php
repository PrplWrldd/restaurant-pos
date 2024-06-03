<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant POS</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    }
    .navbar-brand {
        color: #333;
        font-weight: bold; /* Make the brand name bold */
    }
    .nav-item {
        margin-right: 40px; /* Increase right margin */
    }
    .nav-link {
        color: #333;
        text-decoration: none; /* Remove underline */
        padding: 4px 6px; /* Add padding */
        margin-bottom: 20px; /* Increase bottom margin */
        border: 1px solid #333; /* Add border */
        border-radius: 5px; /* Rounded corners */
        background-color: #f8f9fa; /* Add background color */
        transition: color 0.3s ease, background-color 0.3s ease; /* Transition effect */
    }
    .nav-link:hover {
        color: #007bff;
        background-color: #e2e6ea; /* Darker shade when hovered */
    }
    .container {
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Restaurant POS</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.create') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu-items.index') }}">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">Kitchen</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.completed') }}">Completed Orders</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
