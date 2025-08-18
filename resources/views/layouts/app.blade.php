<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optionnel : votre CSS perso -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

     {{-- DataTables CSS (chargé une fois pour toute l’appli) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
</head>
<body>
    <div class="min-vh-100 bg-light d-flex flex-column">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm">
                <div class="container py-3">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow-1">
            <div class="container my-4">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS (optionnel pour composants dynamiques) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

     {{-- jQuery et DataTables JS chargés une seule fois --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

     {{-- Script global pour toutes les tables --}}
    <script>
        $(document).ready(function () {
            $('.datatable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
                },
                pageLength: 10
            });
        });
    </script>


    @stack('scripts')
</body>
</html>
