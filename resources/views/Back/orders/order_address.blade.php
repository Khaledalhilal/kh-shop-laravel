@extends('back.layouts.master')
@section('content')
    <style>
        .selected-option {
            background-color: #4e73df !important;
            color: black;
        }
    </style>
    <div class="container-fluid">

        <div class="shadow py-2 mb-2 bg-white">
            <h1 class="h3 mb-2  ml-4 text-gray-800">
                <a href="" class="text-gray-800 active">Order Details: #Order-78414</a>
            </h1>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                    Order Created at:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter text-center">
                                    {{ $allOrders->first()->order->date }}
                                </div>
                            </div>
                            <div class="col-auto ">
                                <i class="fa-solid fa-shopping-cart fa-2x text-primary "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Name</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter text-center" style="#a3cfbb">
                                    {{ $allOrders->first()->order->users->name }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-address-book fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">E-mail</div>
                                <div class="row no-gutters align-items-center">
                                    {{-- <div class="col-2"></div> --}}
                                    <div class="col-12">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-dark counter text-center">
                                            {{ $allOrders->first()->order->users->email }}</div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Contact Number</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter text-center">
                                    {{ $allOrders->first()->order->users->phone_number }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-address-card fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 shadow" style="border-radius:0px;height: 250px !important;">
                    <div class="card-header border-0 text-bold"
                        style="font-size: 20px;font-weight:bolder;background-color:none;">
                        Delivery Address
                    </div>
                    <div class="m-2"></div>
                    <div class="row d-flex m-1">
                        <div class="col-6">Country:</div>
                        <div class="col-6">{{ $allOrders->first()->order->order_address->country }}</div>
                    </div>
                    <div class="row d-flex m-1">
                        <div class="col-6">State:</div>
                        <div class="col-6">{{ $allOrders->first()->order->order_address->state }}</div>
                    </div>
                    <div class="row d-flex m-1">
                        <div class="col-6">City:</div>
                        <div class="col-6">{{ $allOrders->first()->order->order_address->city }}</div>
                    </div>
                    <div class="row d-flex m-1">
                        <div class="col-6">Street Number:</div>
                        <div class="col-6">{{ $allOrders->first()->order->order_address->street_number }}</div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card mb-4 shadow" style="border-radius:0px;height: 250px !important;">
                    <div class="card-header border-0 text-bold"
                        style="font-size: 20px;font-weight:bolder;background-color:none;">
                        Order Status
                    </div>
                    <div class="m-2"></div>
                    <div class="row d-flex m-1">
                        <div class="dropdown-group align-items-center col-6" style="width:200px;">
                            @php
                                $status = $allOrders->first()->order->status;
                            @endphp
                            <select id="status" size="1" name="status" style="width:100% !important">
                                <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}
                                    class="{{ $status == 'Pending' ? 'selected-option' : '' }}">Pending</option>
                                <option value="Shipped" {{ $status == 'Shipped' ? 'selected' : '' }}
                                    class="{{ $status == 'Shipped' ? 'selected-option' : '' }}">Shipped</option>
                                <option value="Delivered" {{ $status == 'Delivered' ? 'selected' : '' }}
                                    class="{{ $status == 'Delivered' ? 'selected-option' : '' }}">Delivered</option>
                            </select>

                        </div>
                        <div class="col-1"></div>
                        <div class="col-3"><button class="btn btn-danger" id="updateStatus">Update</button></div>
                    </div>




                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header" style="font-weight: bolder;font-size:20px;letter-spacing:1.5px;">
                Order Summary
                <div class="text-danger error_message" id="statusError"></div>

            </div>
            <div class="card-body mt-2">
                <div class="table-responsive mb-0">
                    <table class="table" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center"
                                style="color:#343a40;background-color: #FFD333;border-radius:0px !important;">
                                <th scope="">Product Name</th>
                                <th scope="">Quantity</th>
                                <th scope="" style="width: 325px !important;">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allOrders as $item)
                                <tr class="text-center">
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><span style="margin-left: 50px;">{{ $item->product->price }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <div class="row mt-0">
                    <div class="col-xl-4"></div>
                    <div class="col-xl-4"></div>
                    <div class="col-xl-4">
                        <div class="card mb-4 " style="border-radius:0px;height: 250px !important;border:0px">
                            <div class=""></div>
                            <div class="row d-flex ml-1">
                                <div class="col-6">Sub total: </div>
                                <div class="col-6"><span id="subtotal"></span></div>
                            </div>
                            <div class="row d-flex mt-1 ml-1">
                                <div class="col-6">Discount (-):</div>
                                <div class="col-6">%
                                    <span id="discount">
                                        {{ $allOrders->first()->order->couponDiscount }}
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex m-3">
                                <div class="col-6">Total: </div>
                                <div class="col-6"><span id="total"></span></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('.error_message').html(' ');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#updateStatus').click(function() {
                var newStatus = $('#status').val();
                var orderId = '{{ $allOrders->first()->order->id }}';

                if (newStatus == 'Pending') {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You Change the order status to pending !!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Change it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateOrderStatus(orderId, newStatus);

                        }
                    });
                } else {
                    updateOrderStatus(orderId, newStatus);
                }
            });

            function updateOrderStatus(orderId, newStatus) {

                $.ajax({
                    url: '/update-order-status/' + orderId,
                    type: 'PUT',
                    data: {
                        order_id: orderId,
                        new_status: newStatus
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.status === 'error') {
                            $('#statusError').html(xhr.responseJSON.message);
                        }
                    }

                });
            }

            var subtotal = 0;
            var discountPercentage = {{ $allOrders->first()->order->couponDiscount }};

            // Iterate through each item and sum up the prices
            @foreach ($allOrders as $item)
                subtotal += {{ $item->quantity }} * {{ $item->product->price }};
            @endforeach
            var discount = (subtotal * discountPercentage) / 100;
            var total = subtotal - discount;

            subtotal = subtotal.toFixed(2);

            $('#subtotal').text('$' + subtotal);
            $('#total').text('$' + total.toFixed(2));
        });
    </script>
@endsection
