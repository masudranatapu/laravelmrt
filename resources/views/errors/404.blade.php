<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not found</title>
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.cs') }}s">
    <link rel="stylesheet" href="{{ asset('backend/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('backend/img/favicon.ic') }}o' />
</head>

<body>

    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">
                        <h3>Oops! Page not found. 404</h3>
                        <div class="page-description">
                            We could not find the page you were looking for.
                            <br>
                            Meanwhile, you may return to dashboard or try using the search form.
                        </div>
                        <div class="page-search">
                            <div class="mt-3">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-angle-double-left"></i>
                                    Back to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('backend/js/app.js') }}"></script>
</body>

</html>
