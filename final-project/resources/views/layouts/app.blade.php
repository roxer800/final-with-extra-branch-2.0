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



    <style>
        .header {
            display: flex;
            justify-content: space-between;
        }

        .image {
            height: 328px;
            widows: 248px;
            object-fit: cover;
        }

        .pictures-section {
            height: 600px;
        }

        .picture-section {

            height: 600px;
        }

        .description {
            height: 100%;
        }

        .image {
            height: 100%;
            width: 100%
        }

        .additional-image {
            width: 240px;
            height: 30%;
            margin-bottom: 30px;
        }

        .image {
            height: 328px;
            widows: 248px;
            object-fit: cover;
        }
    </style>

</head>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">


        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>

<script>
    function confirmDelete() {
        return confirm('გსურთ პროდუქტის წაშლა?');
    }
</script>


</html>
