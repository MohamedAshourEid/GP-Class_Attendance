<!DOCTYPE html>
<html lang=lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Sign Up') }}</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
@yield('content')
</body>
<html>
