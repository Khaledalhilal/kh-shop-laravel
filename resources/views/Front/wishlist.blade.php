@extends('Front.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid mt-2">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <a class="breadcrumb-item text-dark active" href="#">Wish list</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="container-fluid bg-white">
        <div class="row px-xl-5 ">
            <div class="col-lg-12 col-md-4 table-responsive">
                <table id="example" class="table table-striped nowrap table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Add To Cart</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allWishlists as $wish)
                            <tr class="text-center">
                                <td>{{ $wish->products->name }}</td>
                                <td>{{ $wish->products->price }}</td>
                                <td>
                                    <a href="{{ route('detailsByProduct', $wish->product_id) }}"
                                        class="btn btn-primary px-3" id="addToCartBtn">
                                        <i class="fa fa-shopping-cart mr-1"></i>
                                    </a>
                                </td>
                                <td>
                                    <button class="Remove btn btn-sm btn-danger" data-id="{{ $wish->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.Remove').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '/wishlist/delete/' + id,
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
