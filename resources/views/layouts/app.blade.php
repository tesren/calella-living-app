<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-ML6DCSQ3');</script>
        <!-- End Google Tag Manager -->
        

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

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML6DCSQ3"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <!-- Page Content -->
        <main class="position-relative">
            
            <livewire:navbar />

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