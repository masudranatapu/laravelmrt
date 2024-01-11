<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('backend/img/favicon.ico') }}' />
    @include('backend.layouts.partials.style')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
               @include('backend.layouts.partials.header')
            </nav>
            <div class="main-sidebar sidebar-style-2">
                @include('backend.layouts.partials.sidebar')
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
                {{-- for setting sidebar  --}}
                @include('backend.layouts.partials.settingSidebar')
            </div>
            <footer class="main-footer">
                @include('backend.layouts.partials.footer')
            </footer>
        </div>
    </div>
    {{-- script --}}
    @include('backend.layouts.partials.script')
</body>

</html>
