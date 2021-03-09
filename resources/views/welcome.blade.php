<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-red-500 to-pink-500 h-screen antialiased leading-none text-white">
    <div class="min-h-screen flex flex-col">
        @if(Route::has('login'))
            <div class="bg-black bg-opacity-25 p-4 flex justify-end">
                @auth
                    <a href="{{ url('/home') }}" class="hover:underline text-sm font-normal uppercase">{{ __('Home') }}</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline text-sm font-normal uppercase pr-6">{{ __('Login') }}</a>
                @endauth
            </div>
        @endif

        <div class="flex-1 flex items-center justify-center p-4">
            <div class="flex flex-col justify-around h-full">
            <div class="text-center">
                <h1 class="text-6xl">Welcome to {{ config('meetup.site_name') }}</h1>
                <a class="inline-block mt-10 text-4xl bg-white text-red-500 rounded p-3" href="/register">Join Us</a>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
