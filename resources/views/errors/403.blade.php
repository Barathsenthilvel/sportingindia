
@section('title', 'Unauthorized Access')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="display-3">403</h1>
                <h3 class="mb-4">Unauthorized Access</h3>
                <p class="lead">Sorry, you are not authorized to access this page.</p>
                <a href="{{ route('user.profile') }}" class="btn btn-primary">Go Profile</a>
            </div>
        </div>
    </div>
@endsection

<div class="content" style="margin-left: 250px; padding-top: 70px;">
    @yield('content')
</div>
