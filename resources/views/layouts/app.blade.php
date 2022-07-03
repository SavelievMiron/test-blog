<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.head')

<body class="bg-white font-family-karla">

@include('layouts.header')
    @yield('content')
@include('layouts.footer')

</body>
</html>
