<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <title>Dashboard</title>
    @vite(['resources/css/dashboard.css'])
</head>
<body>
    <div class="sidebar-container">
        <div class="nav-logo">
            <img src="{{ asset('photos/UMDiningcenter.png') }}" alt="UM Dining Center Logo" class ="dashboard-logoDiningCenter">
        </div>
        <div class="nav-general">
            <h1>General</h1>
        </div>
        <div class="navigation-container">
            <nav class = "navigation">
                <ul class = "navigation-ul">
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Sales</a></li>
                    <li><a href="">Inventory</a></li>
                    <li><a href="{{ url('/menu-pricing')}}">Menu and Pricing</a></li>
                    <li><a href="">Kitchen Production</a></li>
                    <li><a href="">Cost and Variance Analysis</a></li>
                </ul>
                <button>Logout</button>
            </nav>
        </div>
    </div>
</body>
</html>