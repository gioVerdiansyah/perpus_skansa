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

        <script src="https://kit.fontawesome.com/80e53aea6c.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900" id="content" hidden>
            @auth
                @include('layouts.navigation')
            @endauth
            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-row items-center justify-between">
                        {{ $header }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <div id="loading-container" class="loading-hidden position: absolute">
            @vite('resources/scss/loading.scss')
            @include('layouts.loading')
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    document.getElementById('loading-container').remove();
                    document.getElementById('content').removeAttribute('hidden');
                    @if (session('message'))
                        Swal.fire({
                            icon: "{{ session('message')['icon'] ?? 'success' }}",
                            title: "{{ session('message')['title'] }}",
                            text: "{{ session('message')['text'] }}",
                            timer: 5000,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                    @endif
                    $('#content > main > div > div > form > div > span').css('width', '100%');
                    $('#content > main > div > div > form > div > span > span > span > span')
                        .addClass(['dark:bg-gray-500', 'text-white']);
                }, 3000);
            });
        </script>

    </body>

</html>
