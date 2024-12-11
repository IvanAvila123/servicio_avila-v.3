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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            document.addEventListener('livewire:initialized', () => {
                // Para alertas tipo Toast
                Livewire.on('showToast', (data) => {
                    Toast.fire({
                        icon: data[0].type,
                        title: data[0].message
                    });
                });

                // Para confirmaciones
                Livewire.on('showConfirmDialog', (data) => {
                    Swal.fire({
                        title: data[0].title,
                        text: data[0].text,
                        icon: data[0].icon,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: data[0].confirmButtonText || 'Sí',
                        cancelButtonText: 'Cancelar',
                        background: '#1a1a1a',
                        color: '#ffffff'
                    }).then((result) => {
                        if (result.isConfirmed && data[0].method) {
                            Livewire.dispatch(data[0].method, { id: data[0].id });
                        }
                    });
                });
            });
        </script>
    </body>
</html>
