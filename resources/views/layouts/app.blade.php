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
    <body>
        <div class="min-h-screen d-flex flex-column">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="py-4 border-bottom border-secondary border-opacity-10" style="background-color: rgba(15, 23, 42, 0.4);">
                    <div class="container">
                        <h1 class="h3 mb-0 fw-semibold text-white">{{ $header }}</h1>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow-1 py-5">
                <div class="container">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 border-top border-secondary border-opacity-10 mt-auto text-center text-secondary">
                <div class="container">
                    <p class="mb-0 small">&copy; {{ date('Y') }} DevOps Laravel Pipeline. Built with Laravel 12, Docker & Jenkins.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
