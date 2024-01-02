<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.header')
</head>
<body>
    @include('includes.navbar')
    @yield('content')
    @stack('extra-js-scripts')
</body>

</html>
