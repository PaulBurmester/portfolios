<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-ink">
    @include('layouts.app_navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="border-b border-line">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{ $slot }}
    </main>
</div>
</body>
</html>
