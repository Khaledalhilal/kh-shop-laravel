@extends('back.layouts.master')
@section('content')
    {{-- Add Modal Start  --}}
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form enctype="multipart/form-data" id="addCategoryForm">
                @csrf
                <div class="modal-content" style="border-radius: 0px !important;">
                    <div class="modal-header  text-white" style="background-color: #343a40 !important;">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New Category</h5>
                        <button class="close" type="button btn-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-danger">x</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="" style="width:150px">Category Name</label>
                            </div>
                            <select class="custom-select" id="name" name="name">
                                <option selected disabled>Choose Category Name </option>
                                <option value="Men's Clothing">Men's Clothing</option>
                                <option value="Women's Clothing">Women's Clothing</option>
                                <option value="Kids' Clothing">Kids' Clothing</option>
                            </select>
                        </div>
                        <div class="text-danger error_message mb-3" id="nameError"></div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:150px">Upload Image</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="categoryImage" name="my_work">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        <div class="text-danger error_message mb-3" id="imageError"></div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn "
                            style="background-color:#FFD333 !important;color:black">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Add Modal End  --}}

    {{-- Update Modal Start --}}
    <div class="modal fade" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px !important;">
                <div class="modal-header  text-white" style="background-color: #343a40 !important;">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form id="updateCategoryForm" action="{{ route('categories.update', 1) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" name="id" id="id" hidden>
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <select class="form-control" name="name" id="updateCategoryName">
                                <option selected disabled>Choose Category Name</option>
                                @foreach ($getAllCategories as $cat)
                                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-danger error_message mb-3" id="UpdatenameError"></div>


                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="categoryImage" name="my_work">
                                <label class="custom-file-label" for="categoryImage">Choose file</label>
                            </div>
                            <div class="text-danger error_message" id="UpdateimageError"></div>
                        </div>
                        <div id="imagee"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary border-0"
                            style="background-color:#FFD333 !important;color:black">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Update Modal End --}}

    <div class="container-fluid" style="border-radius: 0px">
        <div class="shadow py-2 mb-2 bg-white">
            <h1 class="h3 mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}"
                    class="text-gray-800">Dashboard </a>/ <a href="{{ route('categories.index') }}"
                    class="text-gray-800">Categories</a></h1>
        </div>
        <div class="card shadow mb-4" style="border-radius: 0px">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="m-0 font-weight-bold text-primary"></span>
                <span class="m-0 font-weight-bold text-primary text-end">
                    <button class="btn p-2" style="background-color:#FFD333 !important;color:black;border-radius:0px"
                        data-toggle="modal" data-target="#addCategory"><i class="fa-regular fa-square-plus"
                            style="font-size: 18px"></i> Add Category</button>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive table-hover table-striped">
                    <table class="table " id="dataTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr class="text-center mb-4"
                                style="background-color: #FFD333;border-radius:0px !important;color:#343a40;">
                                <th scope="col-3 ">Image</th>
                                <th scope="col-3">Name</th>
                                <th scope="col-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getAllCategories as $cat)
                                <tr class="text-center">
                                    <td><img src="Back/img/category/{{ $cat->image }}" width="60px" height='60px'
                                            alt=""></td>
                                    <td>{{ $cat->name }}</td>
                                    <td>
                                        <a data-id="{{ $cat->id }}" class="delete"
                                            style="text-decoration:none !important;">
                                            <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;"
                                                title="Delete"></i>
                                        </a>
                                        <button type="button" class="btn edit "
                                            style="background-color: transparent !important;" id="{{ $cat->id }}"
                                            name="{{ $cat->name }}" img="{{ $cat->image }}" data-toggle="modal"
                                            data-target="#updateCategory">
                                            <i class=" fa-solid fa-pen-to-square" style="color: green;"
                                                title="Update"></i>
                                        </button>
                                    </td>
                                </tr>
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

            $('#addCategoryForm').on('submit', function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('categories.store') }}',
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
                                window.location.reload();
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
                            url: '/categories/' + id,
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: response.message,
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.reload();
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

            $('.edit').on('click', function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var img = $(this).attr('img');

                $('#id').val(id);
                $('#updateCategoryName').val(name);

                $('#imagee').html('<img src="{{ asset('back/img/category/') }}' + '/' + img +
                    '" height="150px" width="150px" alt="">');
            });



            $('#updateCategoryForm').submit(function(e) {
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
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            });
                        }
                    },
                    error: function(error) {
                        $('#UpdatenameError').html(error.responseJSON.errors.name)
                        if (error.responseJSON.errors.my_work)
                            $('#UpdateimageError').html('the Image field is required')
                    }
                });
            });

        });
    </script>

    <script>
        function table() {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById('table').innerHTML = this.responseText;
            }
            xhttp.open("GET", 'RealTimeDataDisplay.php');
            xhttp.send();
        }
    </script>
@endsection
