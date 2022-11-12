<!DOCTYPE html>
<html lang="en" class="h-100">

@include('layouts.head')

<body class="h-100">
<div class="wrapper h-100 d-flex flex-column">

    @include('layouts.header')

    <div class="main text-dark flex-grow-1">

        @yield('main')

    </div>
    <div class="footer">
        <div class="container">

        </div>
    </div>
</div>
</body>
<script src="resources/js/script.js"></script>
</html>
