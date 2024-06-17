<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polanca GYM | {{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-900">
    @include("partial.navbar")

    @yield('main-body')
    @stack("scripts")
</body>
</html>
