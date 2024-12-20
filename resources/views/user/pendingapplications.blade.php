<!-- Main Content -->
@extends('layouts.sidebar')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<div class="content" style="margin-left: 250px; padding-top: 70px;">
    @yield('content')
    <div class="container">
        <h1>User List</h1>
        <table id="pending-applications" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                    <th>Actions</th>
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

        $('#pending-applications').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('pending.applications') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        function approveUser(userid)
        {
            $.ajax({
                url: '{{ route('approve.application') }}/'+userid,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log('Success:', response);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function rejectUser(userid)
        {
            $.ajax({
                url: '{{ route('reject.applications') }}/'+userid, // API endpoint
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log('Success:', response);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }



    });
</script>
</html>
