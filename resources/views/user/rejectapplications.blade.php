<!-- Main Content -->
@extends('layouts.sidebar')
<div class="content" style="margin-left: 250px; padding-top: 70px;">
    @yield('content')
    <div class="container">
        {{-- @dd($summary); --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
                <div class="app-card h-200" style="background: lightseagreen;height: 150px;">
                        <div style="padding: 30px;">
                            <span class="text-white"> {{ $summary['pending_count'] }}</span>
                            <h4 class="f-16 fw-600 text-white mb-0 mt-0">Pending Applications</h4>
                        </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>

            <!-- Second Card -->
            <div class="col">
                <div class="app-card h-200" style="background: lightseagreen;height: 150px;">
                    <div style="padding: 30px;">
                            <span class="text-white">{{ $summary['approval_count'] }} </span>
                            <h4 class="f-16 fw-600 text-white mb-0 mt-0">Approved Applications</h4>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>

            <div class="col">
                <div class="app-card h-200" style="background: lightseagreen;height: 150px;">

                        <div style="padding: 30px;">
                            <span class="text-white"> {{ $summary['rejected_count'] }} </span>
                            <h4 class="f-16 fw-600 text-white mb-0 mt-0">Reject Applications</h4>
                        </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>

            <!-- Add more cards as needed -->
        </div>
    </div>
    {{-- csss --}}
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
