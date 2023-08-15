<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->

        <style>
            .logo-item {
                font-size: 26px;
            }

            .report-list-area {
                background: white;
            }
            .group-list-area {
                background: #56A67F;
                height: 885px;
            }

            .centered-content {
                text-align: center;
            }

            .color-level-good {
                color: #229E97;
            }

            .color-level-normal {
                color: #C57E2C;
            }

            .color-level-bad {
                color: #C94F57;
            }

            .index_footer {
                position: fixed;
                bottom: 0;
            }

        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-green-100">
            @if(auth('admins')->user())
                @include('layouts.admin-navigation')
            @elseif(auth('users')->user())
                @include('layouts.user-navigation')
            @endif
            <!-- Page Heading -->
            <header class="shadow">
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
