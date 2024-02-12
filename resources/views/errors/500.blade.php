<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 | Whoopps, something went wrong.</title>
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
                                    <img src="{{ asset('errors/404/error.gif') }}" alt="Error 404">
                                    <h3>Oops! It's not you. 500</h3>
                                    <div class="page-description">
                                        Sorry, it's me, not you.
                                        <br>
                                        You must be try again!
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
