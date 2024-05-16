@extends('Front.layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Breadcrumb Start -->
    <div class="container-fluid mt-3">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ Route('home.index') }}">Home</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @foreach ($specificProduct->images as $key => $img)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img class="w-100 " height="420px" src="{{ asset('Back/img/product/' . $img->image) }}"
                                    alt="Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $specificProduct->name }}</h3>
                    <h3 class="font-weight-semi-bold mb-4">${{ $specificProduct->price }}</h3>
                    <p class="mb-4">
                        {{ $specificProduct->description }}
                        <a id="addToWishlist" class="btn">
                            <span class="bg-primary py-2 px-2"><i class="fa-solid fa-heart-circle-plus ms-4"
                                    style="color: black !important"></i></span>
                        </a>
                    </p>
                    <div class="d-flex ">
                        <strong class="text-dark mr-3">Sizes:</strong>

                        <form>
                            @foreach ($specificProduct->sizes as $sizes)
                                <div class="custom-control text-capitalize custom-radio custom-control-inline mb-3">
                                    <input type="radio" value="{{ $sizes->size }}" class="custom-control-input"
                                        id="size-{{ $sizes }}" name="size">
                                    <label class="custom-control-label"
                                        for="size-{{ $sizes }}">{{ ucfirst($sizes->size) }}</label>
                                </div>
                            @endforeach
                            <span class="error_message_size text-danger "></span>

                        </form>
                    </div>
                    <div class="d-flex ">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <form>
                            @foreach ($specificProduct->colors as $colors)
                                <div class="custom-control custom-radio custom-control-inline mb-4">
                                    <input type="radio" value="{{ $colors->color }}" class="custom-control-input"
                                        id="color-{{ $colors }}" name="color">
                                    <label class="custom-control-label"
                                        for="color-{{ $colors }}">{{ $colors->color }}</label>
                                </div>
                            @endforeach
                            <span class="error_message_color text-danger"></span>

                        </form>
                    </div>
                    <div class="d-flex align-items-center  pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="qty" class="form-control bg-secondary border-0 text-center"
                                value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus" id="btnPlus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="addToCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add
                            To Cart</button>
                    </div>
                    <div class="error_message_qty text-danger mb-4"></div>
                </div>
            </div>
        </div>

    </div>




    {{--
    <div class="mt-5">
        <h2>Session Data:</h2>
        @php
            $sessionData = session()->get('cart', []);
            dd($sessionData);
        @endphp
    </div> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btnPlus').on('click', function(e) {
                $('.error_message_qty').html('');
                var quantity = parseInt($('#qty').val());
                // if (quantity > 5) {
                //     $('#qty').val(5);
                //     $('.error_message_qty').html("You cann't Order more than 5 Products");
                // }
            });

            $('#addToCartBtn').on('click', function(e) {
                var sizeChecked = $('input[name="size"]:checked').val();
                var colorChecked = $('input[name="color"]:checked').val();

                if (!sizeChecked && !colorChecked) {
                    $('.error_message_size').html('Please select size');
                    $('.error_message_color').html('Please select Color');
                    return false;


                }
                if (!sizeChecked) {
                    $('.error_message_size').html('Please select size');
                    return false;
                }


                if (!colorChecked) {
                    $('.error_message_color').html('Please select Color');
                    $('.error_message_size').html(' ');
                    return false;
                }
                $('.error_message_color').html(' ');

                e.preventDefault();
                var quantity = parseInt($('#qty').val());
                var productId = {{ $specificProduct->id }};
                var productName = '{{ $specificProduct->name }}';
                var productPrice = '{{ $specificProduct->price }}';
                var size = $('input[name="size"]:checked').val();
                var color = $('input[name="color"]:checked').val();
                var quantity = parseInt($('#qty').val());
                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.addToCart') }}',
                    data: {
                        productId: productId,
                        productName: productName,
                        productPrice: productPrice,
                        size: size,
                        color: color,
                        quantity: quantity,
                    },
                    success: function(response) {
                        $('.error_message_size').html('');
                        $('.error_message_color').html('');
                        $('.error_message_qty').html('');

                        if (response.status === 'success') {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0'
                                },
                                showClass: {
                                    popup: `
                                    animate__animated
                                    animate__fadeInDown
                                    animate__faster
                                    `
                                },
                                hideClass: {
                                    popup: `
                                    animate__animated
                                    animate__fadeOutUp
                                    animate__faster
                                    `
                                },

                            }).then(function() {
                                window.location.reload();
                            });

                        } else if (response.status === 'quantityExceed') {
                            $('.error_message_qty').html(response.message);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0'
                                }
                            });
                        }
                    },

                });
            });


            $('#addToWishlist').on('click', function(e) {
                e.preventDefault();
                var productId = {{ $specificProduct->id }};
                $.ajax({
                    type: 'POST',
                    url: '{{ route('wishlist.store') }}',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        if (response.status === 'emptyUserSession') {
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0',
                                    cancelButton: 'btn btn-dark border-0 ml-2'
                                },
                                showClass: {
                                    popup: `
                                                    animate__animated
                                                    animate__fadeInDown
                                                    animate__faster
                                                    `
                                },
                                hideClass: {
                                    popup: `
                                                    animate__animated
                                                    animate__fadeOutUp
                                                    animate__faster
                                                    `
                                },
                            });
                        }
                        if (response.status === 'success') {
                            var wishlistCount = parseInt($('#wishListCounter').text());
                            $('#wishListCounter').text(wishlistCount + 1);
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0',
                                    cancelButton: 'btn btn-dark border-0 ml-2'
                                },
                                showClass: {
                                    popup: `
                                                    animate__animated
                                                    animate__fadeInDown
                                                    animate__faster
                                                    `
                                },
                                hideClass: {
                                    popup: `
                                            animate__animated
                                            animate__fadeOutUp
                                            animate__faster
                                            `
                                },
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        if (response.status === 'success') {
                            var wishlistCount = parseInt($('#wishListCounter').text());
                            $('#wishListCounter').text(wishlistCount + 1);
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0',
                                    cancelButton: 'btn btn-dark border-0 ml-2'
                                },
                                showClass: {
                                    popup: `
                                                    animate__animated
                                                    animate__fadeInDown
                                                    animate__faster
                                                    `
                                },
                                hideClass: {
                                    popup: `
                                            animate__animated
                                            animate__fadeOutUp
                                            animate__faster
                                            `
                                },
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0'
                                },
                                showClass: {
                                    popup: `
                                    animate__animated
                                    animate__fadeInDown
                                    animate__faster
                                    `
                                },
                                hideClass: {
                                    popup: `
                                    animate__animated
                                    animate__fadeOutUp
                                    animate__faster
                                    `
                                },
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
