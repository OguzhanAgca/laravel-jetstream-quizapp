<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($header) ? $header." - Laravel" : 'Laravel' }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" /> --}}

        @livewireStyles
        @toastr_css

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-xl flex flex-col items-center sm:rounded-lg">
                        @isset($content)
                            {{ $content }}
                        @endisset
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @jquery
        @toastr_js
        @toastr_render
        {{-- <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script> --}}
        @isset($script)
            {{ $script }}
        @endisset
    </body>
</html>
