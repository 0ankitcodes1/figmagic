@extends("layouts.simpleLayout")
@section("content")
<div style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%);" class="has-text-centered">
     <div><img src="{{ URL::asset('images/green-check.svg') }}" alt="checked sign"></div>
     <h1 class="is-size-1">You are logged in</h1>
     <p>Nizzeed successfully paired with figma. <a class="has-text-danger">Go back to Figma</a></p>
</div>
@stop