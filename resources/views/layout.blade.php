<!DOCTYPE html>
<html>
<head>
    <title>Machine test</title>
    <link href="{{ asset('/assets/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('/assets/js/common.js') }}"></script>
</head>
<body>
@include('header')
@include('sidebar')
@yield('content')
</body>
</html>
