<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo-viejo-bueno.png') }}" type="image/png">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-theme-100 px-8 py-4 rounded-lg shadow-lg w-full mx-2 sm:mx-0 xl:w-2/5 md:w-4/5">
            <div class="text-center">
                <img src="{{ asset('img/logo-viejo-bueno.png') }}" alt="logo-vito" class="mx-auto">
            </div>


            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="username" class="block text-base font-medium text-white">Usuario</label>
                    <input type="text" id="username" name="username" placeholder="Nombre"
                        class="w-full mt-1 p-2 bg-white border-b-2 border-theme-400 focus:outline-none shadow-lg"
                        value="{{ old('username') }}">
                        @error('username')
                            <span class="text-red-500 font-semibold">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-base font-medium text-white">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="******"
                        class="w-full mt-1 p-2 bg-white border-b-2 border-theme-400 focus:outline-none shadow-lg">
                    @error('password')
                        <span class="text-red-500 font-semibold">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                
                @if (session('message_error'))
                <div class="text-red-500 font-semibold">
                    <ul>
                        <li>{{ session('message_error') }}</li>
                    </ul>
                </div>
                @endif

                <div class="flex items-center justify-center mt-10">
                    <button type="submit"
                        class="bg-theme-400 hover:bg-theme-600 text-white font-bold py-2 px-4 rounded transition duration-200 cursor-pointer">
                        Iniciar sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>