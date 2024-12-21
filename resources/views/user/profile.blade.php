@extends('layouts.sidebar') <!-- Extends the sidebar layout -->

@section('content') <!-- Start content section -->
<div class="content" style="margin-left: 250px; padding-top: 70px;">
    <div class="container">
        <h1>My Profile Page</h1>
        <!-- Add your profile details here -->
        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Joined:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>
    </div>
</div>
@endsection <!-- End content section -->

<!-- Navbar -->
<nav class="navbar navbar-light fixed-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <!-- Avatar & Logout -->
            <div class="dropdown">
                <img src="{{ auth()->user() ? auth()->user()->photo : 'default-avatar.png' }}" 
                     alt="Avatar" 
                     class="avatar" 
                     id="navbarDropdown" 
                     data-bs-toggle="dropdown" 
                     aria-expanded="false">
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
