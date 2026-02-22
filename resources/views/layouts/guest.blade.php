<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon"
        href="{{ asset(isset($settings->icon_meta) ? 'storage/' . $settings->icon_meta : 'icon/icon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen grid grid-cols-1 place-content-center justify-items-center gap-12 bg-gray-100 dark:bg-gray-900 p-4">
        
        <div class="w-full sm:max-w-md bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg px-6 py-4">
            <div class="flex justify-center mb-6">
                <a href="/">
                    @if(isset($settings->icon_login))
                        <img src="{{ asset('storage/'.$settings->icon_login) }}" class="h-15 w-30 object-contain">
                    @else
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    @endif
                </a>
            </div>
            {{ $slot }}
        </div>

        <div class="w-full max-w-7xl grid grid-cols-3 gap-4 text-sm text-gray-600 dark:text-gray-400 px-8">
            @if(isset($settings->ig_1))
            <a href="#" class="flex items-center justify-center gap-3 hover:text-gray-900 dark:hover:text-gray-200 transition p-4">
                <img src="{{ asset('storage/'.$settings->ig_1) }}" class="h-8 w-8 object-contain">
                <span class="font-medium">{{ $settings->link_ig_1 }}</span>
            </a>
            @endif

            @if(isset($settings->ig_2))
            <a href="#" class="flex items-center justify-center gap-3 hover:text-gray-900 dark:hover:text-gray-200 transition p-4">
                <img src="{{ asset('storage/'.$settings->ig_2) }}" class="h-8 w-8 object-contain">
                <span class="font-medium">{{ $settings->link_ig_2 }}</span>
            </a>
            @endif
            
            @if(isset($settings->logo_website))
            <a href="{{ $settings->link_website ?? '#' }}" target="_blank" class="flex items-center justify-center gap-3 hover:text-gray-900 dark:hover:text-gray-200 transition p-4">
                <img src="{{ asset('storage/'.$settings->logo_website) }}" class="h-8 w-8 object-contain">
                <span class="font-medium">{{ $settings->link_website }}</span>
            </a>
            @endif
        </div>
    </div>
</body>

</html>
