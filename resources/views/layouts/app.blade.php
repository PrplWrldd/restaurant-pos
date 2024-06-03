<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite('resources/css/app.css')

    <title>Restaurant POS</title>
</head>
<body>
    <nav class="flex sticky top-0 bg-orange-500 p-5 justify-around">
        <a class="" href="#">Restaurant POS</a>
            <ul class="flex gap-3">
                <li>
                    <a href="{{ route('orders.create') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('menu-items.index') }}">Admin</a>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}">Kitchen</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.completed') }}">Completed Orders</a>
                </li>
            </ul>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
