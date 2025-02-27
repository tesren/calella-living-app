<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">

        @yield('titles')

        @vite(['resources/css/app.css'])

        @include('components.favicon')

        @livewireStyles
        
    </head>

    <body>

        <!-- Page Content -->
        <main class="position-relative">
            <livewire:nav-bar />

            <div>
                {{ $slot }}
            </div>
        </main>

  
        <livewire:whatsapp-btn />

        {{-- Footer --}}
        @include('components.footer')



        @vite(['resources/js/app.js'])
        
        @livewireScripts
    </body>

</html>