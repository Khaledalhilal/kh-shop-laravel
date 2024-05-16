@extends('back.layouts.master')
@section('content')
    <div class="shadow py-2 m-3 bg-white">
        <h1 class="h3 mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard </a>/
            <a href="{{ route('profile.admin') }}" class="text-gray-800">Profile</a>
        </h1>
    </div>
    <div class="card shadow m-4 align-items-center text-dark" style="border-radius: 0px;">
        <div style="width: 50%">
            <form id="UpdatePro" action="{{ route('profile.updateAdminPassword', 1) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row ml-4 " style="margin-left: 20px !important; ">
                    <div class="ms-4 col-12 p-3 py-5 bg-white">
                        <div class="row ">
                            <div class="col-md-12"><label class="labels">Current Password <span class="text-danger"
                                        id="oldPassError"></span></label>
                                <input type="password" name="oldPass" class="form-control" placeholder="Enter Password"
                                    value="">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="labels">New Password
                                    <span class="text-danger" id="newPassError"></span>
                                </label>
                                <input type="password" id="txtNewPassword" name="newPass" class="form-control"
                                    placeholder="Enter New Password" value="">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="labels"> Confirm Password
                                    <span class="text-danger" id="repeatNewPassError"></span>
                                </label>
                                <input type="password" id="txtConfirmPassword" name="repeatNewPass" class="form-control"
                                    placeholder="Reapet New Password" value="">
                            </div>
                        </div>
                        <div class="registrationFormAlert" style="color:green;" id="CheckPasswordMatch"></div>
                        <div class="row mt-2">
                            <div class="col"></div>
                            <div class="col mt-2" style="margin-left:400px">
                                <button id="update" class="btn btn-primary profile-button ml-4"
                                    type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ URL::asset('Back/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('Back/assets/js/jquery.toast.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function checkPasswordMatch() {
            var password = $("#txtNewPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch").html("Passwords do not match!");
                $("#update").prop('disabled', true);
            } else {
                $("#CheckPasswordMatch").html("Passwords match.");
                $("#update").prop('disabled', false);
            }
        }

        $(document).ready(function() {
            $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });
    </script>

    {{-- ! check password Strength --}}
    <script>
        function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            var password = $('#txtNewPassword').val().trim();
            if (password.length < 6) {
                $('#update').prop('disabled', true);
                $('#newPassError').html('(Weak: should be at least 6 characters)').addClass("text-danger");
            } else {
                if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                    $('#newPassError').html('(Strong)').addClass("text-danger");
                    $('#update').prop('disabled', false);
                } else {
                    $('#newPassError').html('(Medium: should include alphabets, numbers, and special characters)').addClass(
                        "text-danger");
                    $('#update').prop('disabled', false);
                }
            }
        }

        $(document).ready(function() {
            // Call checkPasswordStrength when typing in the new password field
            $('#txtNewPassword').on('keyup', checkPasswordStrength);
        });
    </script>


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
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            });
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON.errors.newPass)
                            $('#newPassError').html('(required**)')
                        if (error.responseJSON.errors.oldPass)
                            $('#oldPassError').html('(required**)')
                        if (error.responseJSON.errors.repeatNewPass)
                            $('#repeatNewPassError').html('(required**)')

                    }
                });
            });
        });
    </script>
@endsection
