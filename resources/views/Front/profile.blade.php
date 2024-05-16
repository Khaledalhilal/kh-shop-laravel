@extends('Front.layouts.master')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <span class="breadcrumb-item active">Profile</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container rounded  mt-3 mb-5 text-dark">
        <form id="UpdatePro" action="{{ route('profile.update', 1) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row ml-4 " style="margin-left: 200px !important; ">
                <div class="ms-4 col-8 p-3 py-5 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col d-flex -align-items-center">
                            <img src="../img/profile/{{ $user->image }}" class="rounded-circle"width="100px" /><span
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
                            <input type="number" name="phoneNumber" id="phoneNumber" class="form-control"
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
                        <div class="col-md-12">
                            <label class="labels">Current Password <span class="text-danger"
                                    id=""></span></label>
                            <input type="password" name="oldPass" class="form-control" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">new Password
                                <span class="text-danger" id="passwordError"></span>
                            </label>
                            <input type="password"  onkeyup="checkPasswordStrength();" id="Newpassword" name="newPass" class="form-control" placeholder="Enter New Password"
                                value="">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Confirm Password
                                <span class="text-danger" id=""></span>
                            </label>
                            <input type="password" name="repeatNewPass" class="form-control"
                                placeholder="Reapet Password" value="">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col"></div>
                        <div class="col mt-2" style="margin-left:400px">
                            <button class="btn btn-primary profile-button" id="update" type="submit">Update</button>
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
        // Define the validatePhoneNumber function
        function validatePhoneNumber(phoneNumber) {
            if (phoneNumber.length !== 8 || isNaN(phoneNumber)) {
                $('#phoneNumberError').html('(Phone number should consist of 8 digits)');
                $('#update').prop('disabled', true);
                return false;
            } else {
                $('#phoneNumberError').html('');
                $('#update').prop('disabled', false);
                return true;
            }
        }

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
                        if (error.responseJSON.errors.fName)
                            $('#firstNameError').html('(required**)')
                        if (error.responseJSON.errors.lName)
                            $('#lastNameError').html('(required**)')
                        if (error.responseJSON.errors.phoneNumber)
                            $('#phoneNumberError').html('(must consist of 8 digits**)')
                        if (error.responseJSON.errors.birthDate)
                            $('#birthDateError').html('(required**)')
                        if (error.responseJSON.errors.email)
                            $('#emailError').html('(required**)')
                    }
                });
            });

            // Bind the keyup event to the phoneNumber input field
            $('#phoneNumber').on('keyup', function() {
                var phoneNumber = $(this).val();
                validatePhoneNumber(
                    phoneNumber); // Call validatePhoneNumber function when keyup event happens
            });
        });
    </script>

    {{-- ! check password Strength --}}
    <script>
        function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            var password = $('#Newpassword').val().trim();
            if (password.length < 6) {
                $('#update').prop('disabled', true);
                $('#passwordError').removeClass();
                $('#passwordError').addClass('weak-password');
                $('#passwordError').html("Weak (should be at least 6 characters.)").addClass("text-danger");
            } else {
                if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                    $('#passwordError').removeClass();
                    $('#passwordError').addClass('strong-password');
                    $('#passwordError').html("Strong").addClass("text-danger");
                    $('#update').prop('disabled', false);
                } else {
                    $('#update').prop('disabled', false);
                    $('#passwordError').removeClass();
                    $('#passwordError').addClass('medium-password');
                    $('#passwordError').html("Medium (should include alphabets, numbers and special characters.)").addClass(
                        "text-danger");
                }
            }
        }
    </script>
@endsection
