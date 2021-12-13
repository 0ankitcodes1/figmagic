<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     @include("layouts.head")
</head>
<body>
     @include("layouts.components.dashboard-navbar")
     @yield("content")
     @include("layouts.components.footer")
     @yield("script")
     <script src="{{ env('APP_URL') }}/js/app.js"></script>
</body>
</html>