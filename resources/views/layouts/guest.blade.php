<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased dark:bg-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900" id="content" style="display: none" hidden="hidden">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <div id="loading-container" class="loading-hidden position: absolute">
            @vite('resources/scss/loading.scss')
            @include('layouts.loading')
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', function () {
                setTimeout(() => {
                    document.getElementById('loading-container').remove();
                    document.getElementById('content').removeAttribute('hidden');
                    document.getElementById('content').style.display = 'flex';
                    @if(session('message'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: "{{ session('message')['text'] }}",
                        timer: 5000,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                @endif
                }, 3000);
            });
        </script>
    </body>
</html>
