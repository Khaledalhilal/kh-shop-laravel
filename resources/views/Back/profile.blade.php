@extends('back.layouts.master')
@section('content')
    <div class="shadow py-2 m-3 bg-white">
        <h1 class="h3 mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard </a>/
            <a href="{{ route('profile.admin') }}" class="text-gray-800">Profile</a></h1>
    </div>

    <div class="card shadow m-4" style="border-radius: 0px">
        <form id="UpdatePro" action="{{ route('profile.adminUpdate', 1) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row" >
                <div class="ms-4 col-12 p-3 py-5 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col d-flex -align-items-center">
                            <img src="../../img/profile/{{ $user->image }}" class="rounded-circle"width="100px" /><span
                                class="font-weight-bold">
                        </div>
                        <div class="col " style="margin-top: 50px">
                            <input type="file" name="img">
                        </div>
                    </div>
                    <div class="row mt-2">
                        @php
                            $nameParts = explode(' ', $user->name);
                            $firstName = $nameParts[0];
                            $lastName = implode(' ', array_slice($nameParts, 1));
                        @endphp
                        <div class="col-md-6 text-dark">
                            <label class="labels">First Name <span class="text-danger error_message"
                                    id="firstNameError"></span></label>
                            <input type="text" name="fName" class="form-control" placeholder="Enter First Name"
                                value="@php echo $firstName @endphp">
                        </div>
                        <div class="col-md-6 text-dark">
                            <label class="labels">Last Name <span class="text-danger" id="lastNameError"></span></label>
                            <input type="text" name="lName" class="form-control" value="@php echo $lastName @endphp"
                                placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">E-mail <span class="text-danger" id="emailError"></span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your E-mail"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Phone Number <span class="text-danger"
                                    id="phoneNumberError"></span></label>
                            <input type="number" name="phoneNumber" class="form-control"
                                placeholder="Enter Your Phone Number" value="{{ $user->phone_number }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Birth Date <span class="text-danger"
                                    id="birthDateError"></span></label>
                            <input type="date" name="birthDate" class="form-control" placeholder="Enter Your name"
                                value="{{ $user->birth_date }}">
                        </div>
                    </div>

                    <div class="row mt-2 ml-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineCheckbox1">Gender</label>
                        </div>
                        @if ($user->Gender === 'female')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked name="gender" value="female" type="radio">
                                <label class="form-check-label text-capitalize" for="inlineCheckbox2">Female</label>
                            </div>
                            <div class="form-check form-check-inline mb-4 mt-4">
                                <input class="form-check-input" name="gender" value="male" type="radio">
                                <label class="form-check-label text-capitalize" for="inlineCheckbox3">Male</label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="gender" value="female" type="radio">
                                <label class="form-check-label text-capitalize" for="inlineCheckbox2">Female</label>
                            </div>
                            <div class="form-check form-check-inline mb-4 mt-4">
                                <input class="form-check-input" checked name="gender" value="male" type="radio">
                                <label class="form-check-label text-capitalize" for="inlineCheckbox3">Male</label>
                            </div>
                        @endif
                    </div>


                    <div class="row mt-2">
                        <div class="col"></div>
                        <div class="col mt-2 text-right">
                            <button class="btn btn-danger profile-button" type="submit">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <script src="{{ URL::asset('Back/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('Back/assets/js/jquery.toast.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#UpdatePro').on('submit', function(e) {

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
                        }

                        // if (response.status === 'success') {
                        //     Swal.fire({
                        //         icon: 'success',
                        //         title: response.message,
                        //         showConfirmButton: true,
                        //         customClass: {
                        //             confirmButton: 'button btn btn-primary app_style'
                        //         }
                        //     }).then(function() {
                        //         window.location.reload();
                        //     });
                        // }
                        else {
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
                        if (error.responseJSON.errors.fName)
                            $('#firstNameError').html('(required**)')
                        if (error.responseJSON.errors.lName)
                            $('#lastNameError').html('(required**)')
                        if (error.responseJSON.errors.phoneNumber)
                            $('#phoneNumberError').html('(must be consist of 8 digits**)')
                        if (error.responseJSON.errors.birthDate)
                            $('#birthDateError').html('(required**)')
                        if (error.responseJSON.errors.email)
                            $('#emailError').html('(required**)')
                    }
                });
            });
        });
    </script>
@endsection
