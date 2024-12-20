<!-- Main Content -->
@extends('layouts.sidebar')
<div class="content" style="margin-left: 250px; padding-top: 70px;">
    @yield('content')
    <div class="container">
            <h1>My Profile Page</h1>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-light fixed-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <!-- Avatar & Logout -->
            <div class="dropdown">
                <img src="{{ auth()->user() ? auth()->user()->photo : null  }}" alt="Avatar" class="avatar" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
</body>
</html>
