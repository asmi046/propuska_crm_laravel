<!DOCTYPE html>
<x-header-html></x-header-html>
<body>
    @include("allicon")
    <x-menues.side-menu></x-menues.side-menu>
    <main id="main">
        <x-head.head></x-head.head>
        @yield('main')
    </main>
</body>
</html>
