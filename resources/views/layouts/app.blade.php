<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Online Voting System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">


</head>

<body>
    <div class="min-h-screen bg-gray-100">

        <!-- Error and Success Messages -->
        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <!-- Page Heading -->
        <div class="min-h-screen flex flex-col">
            @include('layouts.navbar')
            <div class="flex flex-1">
                @include('layouts.sidebar')
                <main class="bg-white-medium flex-1 p-3 overflow-hidden">
                    <!-- Page Content -->
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>


</html>