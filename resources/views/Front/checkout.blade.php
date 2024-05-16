@extends('Front.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid mt-2">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->




    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                        Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    {{-- <div class="text-danger text-bold h6 text-capitalize text-center">note: you can change your shipping
                        address by update your address**</div> --}}
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label>Street Number </label>
                            <input class="form-control" name="street_number" type="number"
                                value="{{ $address->street_number }}" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control" type="text" type="text" disabled
                                value="{{ $address->country }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State </label>
                            <input class="form-control" type="text" type="text" disabled
                                value="{{ $address->state }}">

                        </div>
                        <div class="col-md-6 form-group">
                            <label>City </label>
                            <input class="form-control" type="text" type="text" disabled value="{{ $address->city }}">
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-radio custom-control-inline mb-4">
                            <input type="radio" class="custom-control-input" id="sameAdd" name="shippingOption" checked>
                            <label class="custom-control-label" for="sameAdd">Ship to Same address</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-radio custom-control-inline mb-4">
                            <input type="radio" class="custom-control-input" id="sameAdd3" name="shippingOption">
                            <label class="custom-control-label text-danger" for="sameAdd3" data-toggle="collapse"
                                data-target="#shipping-address">Ship to different address</label>
                        </div>
                    </div>


                    <div class="collapse mb-5" id="shipping-address">

                        <form id="updateAddressForm" action="{{ route('address.update', 1) }}">

                            <div class="row">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6 form-group">
                                    <label>Street Number** </label>
                                    <span class="text-danger error_message mb-4" id="streetError"></span>
                                    <input class="form-control" name="street_number" type="number"
                                        placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Country**</label>
                                    <span class="text-danger error_message mb-4" id="countryError"></span>

                                    <select id="Country" size="1" name="country" style="width:100% !important"
                                        class="form-control">
                                        <option value="" selected="selected">{{ $address->country }}
                                        </option>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label>State** </label>
                                    <span class="text-danger error_message mb-4" id="stateError"></span>
                                    <select id="State" name="state" size="1" class="form-control">{}
                                        <option value="" selected="selected">{{ $address->state }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>City** </label>
                                    <span class="text-danger error_message mb-4" id="cityError"></span>
                                    <select id="City" name="city" size="1" class="form-control">
                                        <option value="" selected="selected">e.g {{ $address->city }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6 mt-4">
                                    <div class="col-md-12 form-group">
                                        <div class="custom-control text-right">
                                            <button type="submit" class="btn btn-danger">update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        {{-- <h6 class="mb-3">order value</h6> --}}
                        @foreach (session()->get('cart', []) as $cart)
                            <div class="d-flex justify-content-between">
                                <p>{{ $cart['name'] }}</p>
                                <p>$ <span class="cart-item-price">{{ $cart['price'] * $cart['quantity'] }} </span></p>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$ <span id="subtotal"></spani>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Discount</h6>
                            <h6 class="font-weight-medium">%
                                <span id="discount">
                                    @php
                                        $coupon = session()->get('coupon', []);
                                        $couponAmount = 0;
                                        if (!empty($coupon) && isset($coupon['coupon_discount'])) {
                                            $couponAmount = $coupon['coupon_discount']['discount'];
                                        }
                                        echo $couponAmount;
                                    @endphp
                                </span>

                            </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$ <span id="total"></span></h5>
                        </div>
                    </div>
                    <form id="placeOrder">
                        @csrf
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3 mt-3">Place
                            Order</button>
                    </form>
                    <div class="col-md-12 mt-4">
                        <div class="custom-control custom-radio custom-control-inline mb-4">
                            <input type="radio" class="custom-control-input" id="payOnDelivery" checked disabled
                                name="payOnDelivery">
                            <label class="custom-control-label text-danger text-capitalize" for="payOnDelivery">Pay on
                                delivery</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ URL::asset('Front/assets/js/country_city_state.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#updateAddressForm').submit(function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var form = new FormData(this);
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: form,
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON.errors.street_number)
                            $('#streetError').html('(required**)')
                        if (error.responseJSON.errors.city)
                            $('#cityError').html('(required**)')
                        if (error.responseJSON.errors.country)
                            $('#countryError').html('(required**)')
                        if (error.responseJSON.errors.state)
                            $('#stateError').html('(required**)')
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // alert();

            function calculateTotal() {
                var subtotal = 0;
                $('.cart-item-price').each(function() {
                    var price = parseFloat($(this).text());
                    subtotal += price;
                });

                var discountAmount = parseFloat($('#discount').text());

                var total = subtotal - (subtotal * discountAmount / 100);

                $('#subtotal').text(subtotal.toFixed(2));
                $('#total').text(total.toFixed(2));
            }

            // Call calculateTotal function on page load
            calculateTotal();
            $('#placeOrder').on('submit', function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('order.store') }}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            }).then(function() {
                                window.location.href = "{{ route('home.index') }}";
                            });
                        }
                        if (response.status === 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            }).then(function() {
                                window.location.reload();
                            });
                        }


                    },
                    error: function(error) {
                        if (error) {
                            // console.log();
                            $('#nameError').html(error.responseJSON.errors.name)
                            if (error.responseJSON.errors.my_work)
                                $('#imageError').html('Image field is required')

                        }
                    }
                });
            });
        });
    </script>
@endsection
