<!-- Main Content -->
@extends('layouts.sidebar')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<div class="content" style="margin-left: 250px; padding-top: 70px;">
    @yield('content')
    <div class="container">
        <h1>Approved Applications</h1>
        <table id="approved-applications" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
        </table>
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
</body>
<script>
    $(document).ready(function () {

        $('#approved-applications').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('approved.applications') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
            ]
        });
    });
 </script>
</html>
