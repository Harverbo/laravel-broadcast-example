@extends('layouts.app')

@section('content')
    <users v-bind:users-array="{{$users}}" />
@endsection

@section('scripts')
<script>
    window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
</script>
<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
@endsection