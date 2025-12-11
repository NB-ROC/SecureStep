<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    @viteReactRefresh
    @vite(['resources/js/app.tsx'])
</head>
<body class="font-sans antialiased">
<div id="app"></div>
<x-footer-nav
    left-label="Dashboard"
    left-link="/dashboard"
    center-label="SOS"
    right-label="Profile"
    right-link="/profile"
    secondary-label="Map"
    secondary-link="/"
    aux-label="Friends"
    aux-link="/friends"
/>
</body>
</html>
