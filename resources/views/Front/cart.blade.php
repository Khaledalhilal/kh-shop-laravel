@extends('Front.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid mt-4">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    {{-- <div class="mt-5">
        <h2>Session Data:</h2>
        @php
            $sessionData = session()->get('cart', []);
            dd($sessionData);
        @endphp
    </div> --}}

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Cancel</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $cartData = session()->get('cart', []);
                        @endphp

                        @foreach ($cartData as $prod)
                            <tr data-product-id="{{ $prod['id'] }}" data-quantity="{{ $prod['quantity'] }}">
                                <td class="align-middle">{{ $prod['name'] }}</td>
                                <td class="align-middle price">${{ $prod['price'] }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <button class="btn btn-sm btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center quantity-input"
                                            value="{{ $prod['quantity'] }}">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="error_message_qty text-danger mb-4"></div>
                                </td>
                                <td class="align-middle total">$<span>{{ $prod['price'] * $prod['quantity'] }}</span></td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger delete" data-id="{{ $prod['id'] }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger update" disabled data-id="{{ $prod['id'] }}">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code" id="couponValue">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="checkCoupon">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>

                                <span id="subtotal">0</span>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Discount </h6>
                            <h6>%<span id="discount">
                                    @php
                                        $coupon = session()->get('coupon', []);
                                        $couponAmount = 0;
                                        if (!empty($coupon) && isset($coupon['coupon_discount'])) {
                                            $couponAmount = $coupon['coupon_discount']['discount'];
                                        }
                                        echo $couponAmount;
                                    @endphp</span></h6>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$0</h6>
                        </div> --}}
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><span id="finalTotal"></span></h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 proceedToCheckout">Proceed To
                            Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.error_message_qty').html(" ");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('cart.deleteFromCart') }}',
                    method: 'POST',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response.status === '1') {

                            // Reload the page or update the cart contents as needed
                            window.location.reload();
                        }
                    },
                });
            });

            $('.proceedToCheckout').on('click', function(e) {
                e.preventDefault();
                var cartItems = [];
                var discount = parseFloat($('#discount').text()); // Get the discount
                $('.table tbody tr').each(function() {
                    var productId = $(this).data('product-id');
                    var quantity = $(this).data('quantity');
                    var price = parseFloat($(this).find('.price').text().replace('$',
                        '')); // Get the price
                    cartItems.push({
                        id: productId,
                        quantity: quantity,
                        price: price
                    });
                });
                $.ajax({
                    url: '{{ route('checkOut.proceedToCheckout') }}',
                    method: 'POST',
                    data: {
                        cartItems: cartItems,
                        discount: discount // Pass the discount to the server
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = '{{ route('checkout.index') }}';
                        }
                        if (response.status === 'emptyCart') {
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
                        } else if (response.status === 'quantityExceed') {
                            $('.error_message_qty').html(response.message);
                        }
                        if (response.status === 'emptyUserSession') {
                            var formHtml = `
                            <form id="checkSignIn">
                                <div class="form-outline mb-4">
                                    <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Enter Your Phone Number" autocomplete="off"/>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" autocomplete="off" />
                                </div>
                                <div class="row mb-4">
                                    <div class="col d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="rememberMe" checked />
                                            <label class="form-check-label" for="rememberMe"> Remember me </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a href="#!" class="color-red">Forgot password?</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p>Not a member? <a href="register.php">Register</a></p>
                                </div>
                            </form>`;

                            Swal.fire({
                                title: 'Enter your credentials',
                                html: formHtml,
                                showCancelButton: true,
                                confirmButtonText: 'Sign In',
                                cancelButtonText: 'Cancel',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var formData = {
                                        phone_number: $('#phone_number')
                                            .val(),
                                        password: $('#password').val(),
                                        rememberMe: $('#rememberMe').is(':checked')
                                    };

                                    $.ajax({
                                        url: '{{ route('client.check') }}',
                                        type: 'POST',
                                        data: formData,
                                        success: function(response) {
                                            if (response.status ==
                                                'success') {
                                                window.location.href =
                                                    '{{ route('checkout.index') }}'; // Corrected to use route helper function
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Login Failed',
                                                    text: 'Please check your credentials and try again.'
                                                });
                                            }
                                        }
                                    });
                                }
                            });

                        }


                    },

                });
            });



            function updateSubtotalAndTotal() {
                var subTotal = 0;
                $('.table tbody tr').each(function() {
                    var priceText = $(this).find('.price').text().trim();
                    var price = parseFloat(priceText.replace('$', '').replace(',', ''));
                    var quantity = parseInt($(this).find('.quantity input').val());
                    var total = price * quantity;
                    subTotal += total;
                    $(this).find('.total').text('$' + total.toFixed(2));
                });

                $('#subtotal').text('$' + subTotal.toFixed(2));
                var discount = parseFloat($('#discount').text());
                var finalTotal = subTotal - (subTotal * (discount / 100));
                $('#finalTotal').text('$' + finalTotal.toFixed(2));
            }

            updateSubtotalAndTotal();

            $('.btn-plus').on('click', function() {
                var input = $(this).closest('.quantity').find('input');
                $(this).closest('tr').find('.update').prop("disabled", false);
                var currentValue = parseInt(input.val());
                input.val(currentValue);
                updateSubtotalAndTotal();
            });

            $('.btn-minus').on('click', function() {
                var input = $(this).closest('.quantity').find('input');
                $(this).closest('tr').find('.update').prop("disabled", false);

                var currentValue = parseInt(input.val());
                if (currentValue == 0) {
                    input.val(0);
                    updateSubtotalAndTotal();
                }
                if (currentValue > 1) {
                    input.val(currentValue - 1);
                    updateSubtotalAndTotal();
                }
            });

            $('.update').on('click', function(e) {
                e.preventDefault();
                var qty = $(this).closest('tr').find('.quantity input').val();
                var productId = $(this).data('id');
                var errorMessage = $(this).closest('tr').find(
                '.error_message_qty'); // Get the error message element for the updated row
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'POST',
                    data: {
                        quantity: qty,
                        product_id: productId,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $(this).closest('tr').find('.update').prop("disabled", true);
                            errorMessage.html(""); // Clear error message for the updated row
                        }
                        if (response.status === 'quantityExceed') {
                            errorMessage.html(response
                            .message); // Show quantity error message for the updated row
                        }
                        if (response.status === 'error') {
                            removeDiscount();
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0'
                                }
                            });
                        }
                    }.bind(
                    this), // Ensure 'this' refers to the clicked element within the success callback
                });
            });



            $('#checkCoupon').on('click', function(e) {
                e.preventDefault();
                var name = $('#couponValue').val();
                var price = $('#subtotal').text(); // Get the subtotal value
                $.ajax({
                    url: '{{ route('coupon.CheckCoupon') }}',
                    method: 'POST',
                    data: {
                        name: name,
                        price: price, // Pass the subtotal value
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            setDiscount(response.discount);
                        }
                        if (response.status === 'notFound') {
                            removeDiscount();
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0'
                                }
                            });
                        }
                        if (response.status === 'finishLimit') {
                            removeDiscount();
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0'
                                }
                            });
                        }
                        if (response.status === 'emptyInput') {
                            removeDiscount();
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-dark border-0'
                                }
                            });
                        }
                        if (response.status === 'error') {
                            removeDiscount();
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

        });

        function setDiscount(discount) {
            $('#discount').text(discount);
            var subTotal = parseFloat($('#subtotal').text().replace('$', ''));
            var newTotal = subTotal - (subTotal * (discount / 100));
            $('#finalTotal').text('$' + newTotal.toFixed(2));
        }

        function removeDiscount() {
            $('#discount').text('0');
            var subTotal = parseFloat($('#subtotal').text().replace('$', ''));
            $('#finalTotal').text('$' + subTotal.toFixed(2));
        }
    </script>
@endsection
