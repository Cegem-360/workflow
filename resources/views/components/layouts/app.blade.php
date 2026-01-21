<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Munkafolyamat automatizálás | Cégem360 - Szabadítsa fel csapata idejét' }}</title>
        <meta name="description" content="Automatizálja ismétlődő feladatait kód nélkül. Vizuális workflow-builder, trigger-alapú szabályok, automatikus értesítések. 14 napos ingyenes próba.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|poppins:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])

        @filamentStyles
        @livewireStyles

        <style>
            [x-cloak] { display: none !important; }

            .font-heading {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>

    <body class="antialiased bg-white">
        <div class="min-h-screen">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
        @filamentScripts
    </body>

</html>
