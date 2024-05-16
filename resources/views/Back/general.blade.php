
@extends('back.layouts.master')
@section('content')


<div class="container-fluid" style="border-radius: 0px">
    <div class="shadow py-2 mb-2 bg-white">
        <h4 class=" mb-2  ml-4 text-gray-800"><a href="{{route('back.dashboard')}}" class="text-gray-800">Dashboard </a>/ <a href="{{route('general.index')}}" class="text-gray-800">General Information</a></h4>
    </div>
    <div class="card shadow mb-4" style="border-radius: 0px">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color:#FFD333;">
            <div class="row w-100">
                <div class="col-lg-6 col-md-12">
                    <span class="m-0 font-weight-bold" style="color:#343a40;font-size:24px;">Landing Image</span>
                </div>
                <div class="col-lg-6 col-md-12">
                    <span class="m-0 font-weight-bold text-primary text-end">
                       <form id="updateLandingForm" action="{{ route('general.updateLandingImage', 1) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="updateImage" class="custom-file-input" id="inputGroupFile04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary" style="background-color:#343a40 !important;color:white;border-radius:0px">Update Image</button>
                                </div>
                            </div>
                        </form>
                    </span>
                     <div class="text-danger error_message text-end" id="img"></div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <img style="width: 100%; height:350px;" src="{{asset('Back/img/landingImage/'.$getAllInfo[0]->landing_image)}}" >
        </div>
    </div>
</div>
<div class="container-fluid" style="border-radius: 0px">
    <div class="card shadow mb-4" style="border-radius: 0px">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color:#FFD333;">
                <div class="col-lg-12 col-md-12 text-center">
                    <span class="m-0 font-weight-bold " style="color:#343a40;font-size:24px;">Contact Info</span>
                </div>

        </div>
        <div class="card-body">
           <form action="{{route('general.updateContactInfo',1)}}" id="updateContactForm">
            @csrf
                <div class="modal-body">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Phone Number</span>
                        </div>
                        <input type="text" value="{{$getAllInfo[0]->phone_number}}" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" autocomplete="off">
                    </div>
                    <div class="text-danger error_message mb-3" id="phoneError"></div>
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="width: 130px;">E-mail</span>
                        </div>
                        <input type="email" value="{{$getAllInfo[0]->email}}" class="form-control" id="email" name="email" placeholder="Enter Your E-mail" autocomplete="off">
                    </div>
                    <div class="text-danger error_message mb-3" id="emailError"></div>
                    <div class="input-group ">
                        <div class="input-group-prepend" >
                            <span class="input-group-text" id="basic-addon1" style="width: 130px;">Address</span>
                        </div>
                        <input type="text" value="{{$getAllInfo[0]->address}}" class="form-control" id="address" name="address" placeholder="Enter Your Address" autocomplete="off">
                    </div>
                    <div class="text-danger error_message mb-3" id="addressError"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" style="background-color:#343a40 !important;color:white; border-radius:0px">Update</button>
                </div>

        </form>
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

            $('#updateLandingForm').submit(function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var form = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: form,
                    success: function(response) {
                        if (response.status === '1') {
                             window.location.reload();

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
                        if(error.responseJSON.errors.updateImage)
                            $('#img').html('Image field is required')
                    }
                });
            });

              $('#updateContactForm').submit(function(e) {
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
                        if (response.status === '1') {
                                window.location.reload();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            });
                        }
                    },
                    error: function(error) {

                        if(error.responseJSON.errors.phoneNumber)
                             $('#phoneError').html('Phone Number Field is requried')
                        if(error.responseJSON.errors.email)
                             $('#emailError').html('E-mail Field is requried')
                        if(error.responseJSON.errors.address)
                             $('#addressError').html('Address Field is requried')
                    }
                });
            });
    });
</script>

@endsection
