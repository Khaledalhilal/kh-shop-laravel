@include('Front.layouts.header')
@include('Front.layouts.navbar')

<body>

    <!-- Breadcrumb Start -->
    <div class="container-fluid mt-2">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <span class="breadcrumb-item active">Shop Result</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->

    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">

                        </div>
                    </div>
                    @if ($counter == 0)
                    <h1 class="ms-4 text-bold">Product Not Found</h1>
                    @else
                        @foreach ($allProducts as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <a href="{{ route('detailsByProduct', $product->id) }}">
                                            <img class="img-fluid"
                                                src="{{ asset('Back/img/product/' . $product->images->first()->image) }}"
                                                style="width: 100% !important; height: 200px !important;">
                                        </a>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${{ $product->price }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12">
                            {{ $allProducts->links() }}
                        </div>
                    @endif


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('Front.layouts.scripts')

    {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#search-form').on('click', function(e) {
                e.preventDefault();
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    url: $(this).attr('action'), // Get form action attribute
                    method: $(this).attr('method'), // Get form method attribute
                    data: formData, // Send serialized form data
                    success: function(response) {
                        $('#main-content').hide();
                        $('#search_result').html(response);
                    },
                });
            });
        });
    </script> --}}


    @include('Front.layouts.footer')

    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


</body>

</html>
