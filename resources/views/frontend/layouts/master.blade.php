@include('frontend.layouts.head')

<body>
    <div class="loader"></div>
    <!-- start main nav  -->
    @include('frontend.layouts.nav')
    <!-- end main nav  -->

    @yield('content')
    <!-- start footer -->

    @include('frontend.layouts.footer')

    @include('frontend.layouts.footer-scripts')
</body>

</html>
