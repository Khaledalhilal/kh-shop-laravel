@include('Front.layouts.header')

<body>

    @include('Front.layouts.navbar')

    @yield('content')


    @include('Front.layouts.footer')

    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


  @include('Front.layouts.scripts')
</body>

</html>
