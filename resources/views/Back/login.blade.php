<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign In | MK-shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"href="{{ URL::asset('Back/admin/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('Back/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('Back/admin/css/jquery.toast.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <div class="wrapper" style="background-image: url({{ asset('Back/admin/images/adminLoginBack.png') }});">
        <div class="inner">
            <div class="image-holder">
                <img src="{{ asset('Back/admin/images/adminLogin.png') }}" alt="">
            </div>
            <form action="" id="singUp">
                @csrf
                <h3></h3>
                <div class="form-group">
                </div>
                <div class="form-wrapper">
                    <input type="number" name="phoneNumber" id="phoneNumber" placeholder="Enter Your Phone Number"
                        class="form-control" autocomplete="off">
                    {{-- <i class="zmdi zmdi-account"></i> --}}
                    <div class="error_message " style="color: red;margin-bottom: 25px" id="phoneNumber_error">
                    </div>

                </div>
                <div class="form-wrapper">
                    <input type="password" name="password" id="password" placeholder="Enter Your Password"
                        class="form-control" autocomplete="off">
                    {{-- <i class="zmdi zmdi-lock"></i> --}}
                    <div class="error_message" style="color: red;margin-bottom: 25px" id="password_error"></div>
                </div>

                <button type="submit" id="signIn">Sign In
                    <i class="zmdi zmdi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
    <script src="{{ URL::asset('Back/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('Back/assets/js/jquery.toast.js') }}"></script>
    <script src="{{ URL::asset('Back/assets/js/jquery.toast.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $('#singUp').on('submit', function(e) {
                $("#signIn").prop('disabled', true);
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('admin.check') }}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {

                        if (response.status === 'invalidPhoneNbr') {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: response.message,
                            });
                        }
                        if (response.status === 'invalidPassword') {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: response.message,
                            });
                        }

                        if (response.status === 'success') {

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: response.message,
                            }).then(function() {
                                window.location.href = '{{ route('back.dashboard') }}';
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
                        $("#signIn").prop('disabled', false);

                    },
                    error: function(error) {
                        $("#signIn").prop('disabled', false);
                        if (error) {
                            // console.log();
                            if (error.responseJSON.errors.phoneNumber)
                                $('#phoneNumber_error').html('required*')
                            if (error.responseJSON.errors.password)
                                $('#password_error').html('required*')

                        }
                    }
                });
            });
        });
    </script>


</body>



</html>
