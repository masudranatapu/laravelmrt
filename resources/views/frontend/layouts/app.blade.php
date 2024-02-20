<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('frontend/img/favicon.ico') }}" rel="icon">
    {{-- style --}}
    @include('frontend.layouts.partials.frontend_style')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- loading effect -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- content  -->
        @yield('content')
        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
            @include('frontend.layouts.partials.frontend_footer')
        </div>
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>
    @include('frontend.layouts.partials.frontend_script')
</body>

</html>
