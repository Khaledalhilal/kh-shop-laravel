@extends('back.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="shadow py-2 mb-2 bg-white">
            <h4 class=" mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard </a>/
                <a href="{{ route('orders.index') }}" class="text-gray-800">Orders</a>
            </h4>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body mt-2">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center"
                                style="color:#343a40;background-color: #FFD333;border-radius:0px !important;">
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Date</th>
                                {{-- <th scope="col">Status</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($allOrders as $order)
                                @foreach ($order->order_items as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->product->price }}</td>
                                        <td>{{ $order->couponDiscount }} %</td>
                                        <td>
                                            @php
                                                $subtotal =
                                                    ($item->product->price -
                                                        ($item->product->price * $order->couponDiscount) / 100) *
                                                    $item->quantity;
                                                $total += $subtotal;
                                            @endphp
                                            {{ $subtotal }}
                                        </td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $order->date }}</td>
                                        {{-- <td>
                                            @php
                                                $colorClass = '';
                                                switch ($order->status) {
                                                    case 'Pending':
                                                        $colorClass = 'btn-warning';
                                                        break;
                                                    case 'Shipped':
                                                        $colorClass = 'btn-primary';
                                                        break;
                                                    case 'Delivered':
                                                        $colorClass = 'btn-success';
                                                        break;
                                                    default:
                                                        $colorClass = 'btn-secondary';
                                                        break;
                                                }
                                            @endphp
                                            <button class="btn {{ $colorClass }}"
                                                id="status_{{ $order->id}}"
                                                onclick="toggleStatus('{{ $order->id }}')">{{ $order->status }}</button>
                                        </td> --}}

                                    </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-center"><strong>Total: {{ $total }}</strong></td>
                                <td colspan="4"></td>
                            </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function toggleStatus(orderId) {
            var statusCell = document.getElementById('status_' + orderId);
            var currentStatus = statusCell.innerText.trim();
            var newStatus = '';

            switch (currentStatus) {
                case 'Pending':
                    newStatus = 'Shipped';
                    break;
                case 'Shipped':
                    newStatus = 'Delivered';
                    break;
                case 'Delivered':
                    newStatus = 'Pending';
                    break;
                default:
                    break;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/update-order-status/' + orderId,
                type: 'PUT',
                data: {
                    new_status: newStatus
                },
                success: function(response) {
                    window.location.reload();
                    statusCell.innerText = newStatus;

                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle error
                }
            });
        }
    </script>
@endsection
