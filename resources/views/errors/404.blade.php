<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <style>
        .four_zero_four_bg {
            background-image: url('{{ asset('images/error.gif') }}');
            width: 100%;
            height: 400px;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }
    </style>
</head>

<body>
    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="four_zero_four_bg"></div>
                    <div class="contant_box_404">
                        <h3>Oops! Page not found. 404</h3>
                        <div class="page-description">
                            We could not find the page you were looking for.
                            <br>
                            Meanwhile, you may return to dashboard or try using the search form.
                        </div>
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
    </section>
</body>

</html>
