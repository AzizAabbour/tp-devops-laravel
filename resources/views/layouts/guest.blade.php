<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DevOps Task Manager') }}</title>

        <!-- Bootstrap 5 & Custom SCSS via Vite -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                    <div class="text-center mb-4">
                        <a href="/" class="text-decoration-none">
                            <h2 class="fw-bold text-white tracking-wide">
                                <span class="text-primary">&Delta;</span>ntigravity <span class="fs-6 text-secondary d-block">DevOps Portal</span>
                            </h2>
                        </a>
                    </div>

                    <div class="card shadow p-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
