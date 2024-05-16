@extends('back.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="shadow py-2 mb-2 bg-white">
            <h1 class="h3 mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard
                </a>/ <a href="{{ route('products.index') }}" class="text-gray-800">Products</a></h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="m-0 font-weight-bold text-primary"></span>
                <span class="m-0 font-weight-bold text-primary text-end">
                    <a href="{{ Route('products.create') }}" class="btn p-2"
                        style="background-color:#FFD333 !important;color:black;border-radius:0px"><i
                            class="fa-regular fa-square-plus" style="font-size: 18px"></i> Add Product</a>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center" style="color:#343a40;background-color: #FFD333;border-radius:0px !important;">
                                <th scope="col-2">Image</th>
                                <th scope="col-2">Product Name</th>
                                <th scope="col-2">Sub Category Name</th>
                                <th scope="col-2">Brand Name</th>
                                <th scope="col-2">Price</th>
                                <th scope="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allInfo as $groupedProducts)
                                @foreach ($groupedProducts as $product)
                                    <tr class="text-center">
                                        <td style="width: 120px !important;height: 120px !important;"><img src="{{ asset('Back/img/product/' . $product->images[0]->image) }}"
                                                width="120px" height="100px" alt=""></td>
                                        <td style="width: 120px !important;">{{ $product->name }}</td>
                                        <td style="width: 120px !important;">{{ optional($product->subCategory)->name }}</td>
                                        <td style="width: 120px !important;">{{ $product->brand->name }}</td>
                                        <td style="width: 120px !important;">{{ $product->price }}</td>
                                        <td style="width: 120px !important;">
                                            <a data-id="{{ $product->id }}" class="delete"
                                                style="text-decoration:none !important;">
                                                <button type="button" class="btn "
                                                    style="background-color: transparent !important;">
                                                    <i class="fa-solid fa-trash" style="color: red; margin-right: 0px;"
                                                        title="Delete"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('products.show', $product->id) }}" method="post">
                                                @method("GET")
                                                @csrf
                                                <button type="submit" class="btn "
                                                    style="background-color: transparent !important;">
                                                    <i class="fa-regular fa-eye"style="color: blue; margin-right: 0px;"></i>
                                                </button>
                                            </form>
                                            <a href="{{ Route('products.edit', $product->id) }}">
                                                <button type="button" class="btn "
                                                    style="background-color: transparent !important;">
                                                    <i class=" fa-solid fa-pen-to-square" style="color: green;"
                                                        title="Update"></i>
                                                </button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete').on('click', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            url: '/products/' + id,
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: response.message,
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href =
                                            '{{ route('products.index') }}';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "warning",
                                        title: response.status,
                                        text: response.message,
                                        iconColor: 'red',
                                        customClass: {
                                            confirmButton: 'custom-confirm-button-class',
                                        },
                                        buttonsStyling: false,
                                    });
                                }
                            }
                        });
                    }
                });
            });


        });
    </script>
@endsection
