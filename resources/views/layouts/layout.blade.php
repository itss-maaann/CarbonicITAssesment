<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="navbar-brand">Carbonic Assesment</a>
            <ul class="navbar-menu">
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/orders">Orders</a></li>
                <li><a href="/products">Products</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Carbonic Assessment. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')

</body>
</html>
