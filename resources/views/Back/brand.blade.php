
@extends('back.layouts.master')
@section('content')

{{-- Add Modal Start  --}}
<div class="modal fade" id="addBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form enctype="multipart/form-data" id="addBrandForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header  text-white" style="background-color: #343a40 !important;">
                    <h5 class="modal-title" id="exampleModalLabel1">Add New Brand</h5>
                    <button class="close" type="button btn-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Brand Name</span>
                        </div>
                        <input type="text" class="form-control"  name="name" placeholder="Enter Brand Name" autocomplete="off">
                    </div>
                    <div class="text-danger error_message mb-3" id="nameError"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn " style="background-color:#FFD333 !important;color:black">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Add Modal End  --}}
{{-- Update Modal Start --}}
<div class="modal fade" id="updateBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="modal-header  text-white" style="background-color: #343a40 !important;">
        <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="updateBrandForm" action="{{ route("brands.update", 1) }}" >
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="input-group ">
                    <input type="text" name="id" id="id" hidden>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Brand Name" aria-label="Username" aria-describedby="basic-addon1" autocomplete="off">
                </div>
                <div class="text-danger error_message mb-3" id="UpdatenameError"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn " style="background-color:#FFD333 !important;color:black">Save</button>
            </div>
        </form>
    </div>
</div>
</div>
{{-- Update Modal End --}}

<div class="container-fluid">
    <div class="shadow py-2 mb-2 bg-white">
        <h1 class="h3 mb-2  ml-4 text-gray-800"><a href="{{route('back.dashboard')}}" class="text-gray-800">Dashboard </a>/ <a href="{{route('brands.index')}}" class="text-gray-800">Brands</a></h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <span class="m-0 font-weight-bold text-primary"></span>
            <span class="m-0 font-weight-bold text-primary text-end">
                <button class="btn p-2" style="background-color:#FFD333 !important;color:black;border-radius:0px" data-toggle="modal" data-target="#addBrand"><i class="fa-regular fa-square-plus" style="font-size: 18px"></i> Add Brand</button>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center" style="color:#343a40;background-color: #FFD333;border-radius:0px !important;">
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllBrands as $brand)
                            <tr class="text-center">
                                <td>{{$brand->name}}</td>
                                <td>
                                    <a data-id="{{$brand->id}}" class="delete" style="text-decoration:none !important;">
                                        <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                    </a>
                                    <button type="button" class="btn edit " style="background-color: transparent !important;" id="{{$brand->id}}"  name="{{$brand->name}}"  data-toggle="modal" data-target="#updateBrand">
                                        <i class=" fa-solid fa-pen-to-square" style="color: green;" title="Update"></i>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addBrandForm').on('submit', function (e) {
            e.preventDefault();
            $('.error_message').html('');
            var formData = new FormData(this);
             $.ajax({
                url: '{{ route("brands.store") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response){
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
                    if(response.status==='error'){
                        Swal.fire({
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary'
                            }
                        })
                    }


                },
                error:function(error){
                    if(error){
                        if(error.responseJSON.errors.name)
                        $('#nameError').html('Brand name is required')

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
                            url: '/brands/' + id,
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: response.message,
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = '{{ route("brands.index") }}';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "warning",
                                        title: response.status,
                                        text: response.message,
                                        iconColor: 'red',
                                        customClass: {
                                            confirmButton: 'custom-confirm-button-class', // Apply a custom class to the confirm button
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
                $('#id').val(id);
                $('#name').val(name);
            });

            $('#updateBrandForm').submit(function(e) {
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
                                window.location.href = "{{Route('brands.index')}}";
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

                        if(error.responseJSON.errors.name)
                             $('#UpdatenameError').html('Brand name is requried')
                    }
                });
            });

    });


</script>

@endsection
