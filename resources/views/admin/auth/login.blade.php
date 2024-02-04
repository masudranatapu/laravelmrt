<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Admin Login - MRT POS</title>
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/bundles/bootstrap-social/bootstrap-social.css') }}">
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/components.css') }}">
        <!-- Custom style CSS -->
        <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('backend/img/favicon.ico') }}"/>
    </head>
    <body>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ __('Login') }}</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" class="needs-validation" action="{{ route('admin.login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">{{ __('Email Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" required autofocus placeholder="{{ __('Email Address') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">{{ __('Password') }}</label>
                                                <div class="float-right">
                                                    <a href="{{ route('password.request') }}" class="text-small">
                                                        Forgot Password?
                                                    </a>
                                                </div>
                                            </div>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required placeholder="{{ __('Password') }}">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember" class="custom-control-input"
                                                    tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember-me">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="{{ asset('backend/js/app.js') }}"></script>
        <script src="{{ asset('backend/js/scripts.js') }}"></script>
    </body>
</html>
