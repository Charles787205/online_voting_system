<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.guest_head')
<style>
    .login {
        background: url('./images/login-new.jpeg')
    }
</style>

@props(['additionalBodyClass' => ''])

<body class="h-screen font-sans antialiased {{$additionalBodyClass}}">
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{$slot}}
</body>

</html>