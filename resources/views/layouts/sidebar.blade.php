<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 999;
            background-color: #ffffff;
        }
        .navbar .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown-menu {
            min-width: 10rem;
        }
    </style>

</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        @if(auth()->user()->role_id == 1)
        <a href="{{ route('user.dashboard') }}">Dashboard</a>
        @endif
        @if(auth()->user()->role_id == 1)
            <a href="{{ route('pending.applications') }}">Pending Applications</a>
        @endif

        @if(auth()->user()->role_id == 1)
            <a href="{{ route('approved.applications') }}">Approved Applications</a>
        @endif

        @if(auth()->user()->role_id == 1)
            <a href="{{ route('rejected.applications') }}">Rejected Applications</a>
        @endif

        <a href="{{ route('user.profile') }}">My Profile</a>

        <a class="dropdown-item" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </div>

    <!-- Main Content -->
    <div class="content" style="margin-left: 250px; padding-top: 70px;">
        @yield('content')
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-light fixed-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <!-- Avatar & Logout -->
                <div class="dropdown">
                    <img src="{{ auth()->user() ? auth()->user()->photo : null }}" alt="Avatar" class="avatar" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
</script>
</body>
</html>
