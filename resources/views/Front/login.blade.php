@extends('Front.layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container-fluid mt-2">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                    <span class="breadcrumb-item ">Sign In</span>
                </nav>
            </div>
        </div>
    </div>

    {{-- @php
        $sessionData = session()->get('clientSession', []);
        dd($sessionData);
    @endphp --}}
    <div class="container-fluid ">
        <section class="h-100">
            <div class="container py-5 ">
                <div class="row d-flex justify-content-center align-items-center ">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2">
                            <div class="card-body p-0">
                                <section class="" style="min-height:500px">
                                    <div class="container-fluid h-custom">
                                        <div class="row d-flex justify-content-center align-items-center h-100">
                                            <div class="col-md-9 col-lg-6 col-xl-5 mt-4">
                                                <img src="{{ asset('Front/assets/img/login.jpg') }}" class="img-fluid"
                                                    alt="Sample image">
                                            </div>
                                            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

                                                <div
                                                    class=" mt-5 d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                                    <p class="lead fw-normal mb-0 me-3">Sign in with</p>

                                                    <a href="https://wa.me/70749581"
                                                        class="input-group-text py-2 btn text-decoration-none text-white mx-1 btn bg-blue-color"
                                                        id="basic-addon3"
                                                        style="background-color: #FFD333 !important; color:black;">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>

                                                    <a href="https://wa.me/70749581"
                                                        class="input-group-text py-2 btn text-decoration-none text-white mx-1 btn bg-blue-color"
                                                        id="basic-addon3"
                                                        style="background-color: #FFD333 !important; color:black;">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                    <a href="https://wa.me/70749581"
                                                        class="input-group-text py-2 btn text-decoration-none text-white mx-1 btn bg-blue-color"
                                                        id="basic-addon3"
                                                        style="background-color: #FFD333 !important; color:black;">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                </div>
                                                <div class="divider d-flex align-items-center my-4">
                                                    <p class="text-center fw-bold mx-3 mb-0"></p>
                                                </div>

                                                <form id="singUp" method="post">
                                                    @csrf
                                                    <div class=" input-group">
                                                        <input type="number" class="form-control" name="phone_number"
                                                            placeholder="Enter Phone Number" id="phone_number"
                                                            autocomplete="off" aria-describedby="basic-addon2">
                                                        <span class="input-group-text" id="basic-addon2"
                                                            style="background-color: #FFD333 !important; color:black;">
                                                            <i class="fa-solid fa-phone"></i>

                                                        </span>

                                                    </div>
                                                    <div class="col-10 mb-3 repeat_password_error text-danger"
                                                        id="phoneNbr"></div>

                                                    <div class=" input-group ">
                                                        <input type="password" class="form-control" name="password"
                                                            autocomplete="off" placeholder="Enter Password" id="password"
                                                            aria-describedby="basic-addon2">
                                                        <span class="input-group-text" id="basic-addon2"
                                                            style="background-color: #FFD333 !important; color:black;">
                                                            <i class="fa-solid fa-lock"></i></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-10 mb-3 repeat_password_error text-danger"
                                                        id="pass">
                                                    </div>

                                                    <div class="text-center text-lg-start mt-4 pt-2 mb-4">
                                                        <button type="submit" class="btn bg-blue-color btn-lg"
                                                            style="background-color: #FFD333 !important;padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="{{ URL::asset('Back/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('Back/assets/js/jquery.toast.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#phone_number').on('input', function() {
                $('#phoneNbr').html('');
            });

            // Function to clear password error message
            $('#password').on('input', function() {
                $('#pass').html('');
            });

            $('#singUp').on('submit', function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('client.check') }}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        if (response.status === 'userNotFound') {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
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
                                title: "Invalid Password !!",
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
                                window.location.href = '{{ route('home.index') }}';
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
                            if (error.responseJSON.errors.phone_number)
                                $('#phoneNbr').html('required*')
                            if (error.responseJSON.errors.password)
                                $('#pass').html('required*')


                        }
                    }
                });
            });
        });
    </script>
@endsection
