@extends('layouts.app')
@section('content')
    <div>
        <router-link to="/">Home</router-link>
        <router-link to="/about">About</router-link>
        <router-link to="/login">Login</router-link>
        <router-link to="/register">Register</router-link>
    </div>
{{--    <router-view></router-view>--}}
{{--    <example-component></example-component>--}}

@endsection

