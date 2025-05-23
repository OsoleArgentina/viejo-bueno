<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('img/logo-viejo-bueno.png') }}" type="image/png">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="user-data" content="{{$user ?? null}}">
        
        <title>Administrador</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        {{-- Font awesome --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/admin.js'])

    </head>
    <body>
        <div id="admin">
            {{-- <router-view></router-view> --}}
        </div>
    </body>
</html>