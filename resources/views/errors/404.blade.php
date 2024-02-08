<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img src="{{ asset('images/error.gif') }}" alt="Error 404">
                                    <h3>Oops! Page not found. 404</h3>
                                    <div class="page-description">
                                        We could not find the page you were looking for.
                                        <br>
                                        Meanwhile, you may return to dashboard or try using the search form.
                                    </div>
                                    <div class="page-search">
                                        <div class="mt-3">
                                            <a class="btn btn-primary btn-lg" href="">
                                                <i class="fas fa-angle-double-left"></i>
                                                Back to Home
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
