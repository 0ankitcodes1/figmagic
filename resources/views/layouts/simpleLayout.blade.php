<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include("layouts.head")
</head>

<body class="custom-bg-primary" style="height: 100vh;">
    <div id="body"class="is-flex is-justify-content-center is-align-items-center" style="width:100%;height:100%;">
        @include("layouts.components.simple-navbar")
        @yield("content")
    </div>
    {{-- @include("layouts.components.footer") --}}
    {{-- <script src="{{ URL::asset('js/app.js') }}"></script> --}}
    @yield("script")
</body>

</html>
