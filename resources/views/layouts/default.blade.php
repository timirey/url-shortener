<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">

    <div id="main" class="row">

        @yield('content')

    </div>

    <footer class="row">
        @include('includes.scripts')
    </footer>

</div>
</body>
</html>
