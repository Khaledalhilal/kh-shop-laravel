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
                                <th scope="col">ID</th>
                                <th scope="col">Items</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Date Purchased</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp
                            @foreach ($orders as $order)
                                @foreach ($order->order_items as $item)
                                    @php
                                        $counter++;
                                    @endphp
                                    <tr class="text-center">
                                        <td>#Order-{{ $order->id }}
                                            @if ($counter <= 10 && $order->status == 'Pending')
                                                <span class="text-danger">(New)</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $order->users->name }}</td>
                                        <td>{{ $order->users->phone_number }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>
                                            @if ($order->status == 'Pending')
                                                <div class="bg-danger"
                                                    style="width:100px !important; height:35px !important">
                                                    <span class="text-white p-2" style="font-size: 17px;">
                                                        {{ $order->status }}
                                                    </span>
                                                </div>
                                            @endif
                                            @if ($order->status == 'Delivered')
                                                <div class="bg-success"
                                                    style="width:100px !important; height:35px !important">
                                                    <span class="text-white p-2" style="font-size: 17px;">
                                                        {{ $order->status }}
                                                    </span>
                                                </div>
                                            @endif
                                            @if ($order->status == 'Shipped')
                                                <div class="bg-warning"
                                                    style="width:100px !important; height:35px !important">
                                                    <span class="text-white p-2" style="font-size: 17px;">
                                                        {{ $order->status }}
                                                    </span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('order.address', $order->id) }}"
                                                style="text-decoration:none !important;">
                                                <i class="fa-solid fa-arrow-right"
                                                    style="color: blue; margin-right: 10px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
