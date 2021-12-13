<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include("layouts.head")
</head>

<body>
    <div id="body">
        @include("layouts.components.simple-navbar")
        @yield("content")
    </div>
    {{-- @include("layouts.components.footer") --}}
    {{-- <script src="{{ URL::asset('js/app.js') }}"></script> --}}
    @yield("script")
</body>

</html>
