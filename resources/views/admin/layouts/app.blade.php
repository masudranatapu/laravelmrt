<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('backend/img/favicon.ico') }}' />
    @include('admin.layouts.partials.admin_style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                @include('admin.layouts.partials.admin_header')
            </nav>
            <div class="main-sidebar sidebar-style-2">
                @include('admin.layouts.partials.admin_sidebar')
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
                {{-- for setting sidebar  --}}
                {{-- @include('admin.layouts.partials.admin_settingSidebar') --}}
            </div>
            <footer class="main-footer">
                @include('admin.layouts.partials.admin_footer')
            </footer>
        </div>
    </div>
    {{-- script --}}
    @include('admin.layouts.partials.admin_script')
</body>

</html>
