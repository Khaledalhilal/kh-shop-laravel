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
                                <th scope="col">Order #</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allOrders as $orders)
                                @php $firstIteration = true; @endphp
                                @foreach ($orders as $order)
                                    <tr class="text-center">
                                        @if ($firstIteration)
                                            <td>#1{{ $order->id }}2</td>
                                            <td>
                                                {{ $order->users->name }}
                                                @php $firstIteration = false; @endphp

                                            </td>
                                            <td>
                                                <a href="{{ route('order.address', $order->users->id) }}"
                                                    style="text-decoration:none !important;">
                                                    <i class="fa-solid fa-arrow-right"
                                                        style="color: blue; margin-right: 10px;"></i>
                                                </a>
                                            </td>
                                        @endif
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
