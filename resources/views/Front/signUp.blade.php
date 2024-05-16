@extends('Front.layouts.master')
@section('content')
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }


        .bg-indigo {
            background-color: #FFD333 !important;
        }

        .dropdown-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: auto;
            margin-top: 1rem;
        }

        select {
            width: 100%;
            min-width: 15ch;
            max-width: 30ch;
            border: 1px solid var(--select-border);
            border-radius: 0.25em;
            padding: 0.25em 0.5em;
            font-size: 1.25rem;
            cursor: pointer;
            line-height: 1.1;
            background-color: #fff;
            background-image: linear-gradient(to top, #f9f9f9, #fff 33%);
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="container-fluid mt-3">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <span class="breadcrumb-item active">Sign UP</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <section class="h-100 h-custom ">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <form id="SignUpForm">
                                    @csrf
                                    <div class="row g-0">
                                        {{-- !Personal Info Start --}}
                                        <div class="col-lg-6" style="background-color: #3D464D !important;">
                                            <div class="p-5">
                                                <h3 class="fw-normal mb-5" style="color: #FFD333 !important;">Account
                                                    Information</h3>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12 mb-4 pb-2">
                                                        <div class="form-outline">
                                                            <input type="text" id="fName" name="fName"
                                                                placeholder="eg.Khaled" class="form-control form-control-lg"
                                                                autocomplete="off" />
                                                            <label class="form-label text-white" for="fname">First Name
                                                                <span class="text-danger error_message "
                                                                    id="fNameError"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col mb-4 pb-2">
                                                        <div class="form-outline">
                                                            <input type="text" id="lName" name="lName"
                                                                placeholder="eg.alhilal"
                                                                class="form-control form-control-lg" autocomplete="off" />
                                                            <label class="form-label text-white" for="name">Last Name
                                                                <span class="text-danger error_message mb-4"
                                                                    id="lNameError"></span></label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="email" id="email" name="email"
                                                            placeholder="Enter Your E-mail"
                                                            class="form-control form-control-lg" autocomplete="off" />
                                                        <label class="form-label text-white" for="email">E-mail
                                                            <span class="text-danger error_message" id="emailError"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4 pb-2">
                                                        <div class="form-outline form-white">
                                                            <input type="number" id="phoneNumber" name="phoneNumber"
                                                                class="form-control form-control-lg" placeholder="XXXXXXXX"
                                                                autocomplete="off" />
                                                            <label class="form-label text-white " for="phoneNumber">Phone
                                                                Number <span class="text-danger error_message"
                                                                    id="phoneError"></span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="date" id="birthdate" name="birthDate"
                                                            placeholder="Enter Your Birth Date"
                                                            class="form-control form-control-lg" autocomplete="off" />
                                                        <label class="form-label text-white" for="birthdate">Birth
                                                            Date <span class="text-danger error_message"
                                                                id="dateError"></span></label>
                                                    </div>
                                                </div>
                                                <div class="text-white form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineCheckbox1">Gender</label>
                                                </div>
                                                <div class="text-white form-check form-check-inline">
                                                    <input class="form-check-input" name="gender" value="female"
                                                        type="radio" value="option2">
                                                    <label class="form-check-label text-capitalize"
                                                        for="inlineCheckbox2">Female</label>
                                                </div>
                                                <div class=" text-white form-check form-check-inline mb-4">
                                                    <input class="form-check-input" checked name="gender" value="male"
                                                        type="radio" id="gender" value="option3" value="male">
                                                    <label class="form-check-label text-capitalize"
                                                        for="inlineCheckbox3">male
                                                    </label>
                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="password" name="password" id="password"
                                                            placeholder="Enter Password"
                                                            onkeyup="checkPasswordStrength();"
                                                            class="form-control form-control-lg" autocomplete="off" />
                                                        <label class="form-label text-white" for="password">Password
                                                            <span class="text-danger error_message"
                                                                id="passwordError"></span></label>

                                                    </div>
                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="password" name="RepeatPassword" id="repeatPassword"
                                                            placeholder="Repeat Password"
                                                            class="form-control form-control-lg" autocomplete="off" />
                                                        <label class="form-label text-white" for="repeatPassword">Repeat
                                                            Password <span class="registrationFormAlert"
                                                                style="color:green;" id="CheckPasswordMatch"></span>
                                                            <span
                                                                class="text-danger error_message"id="repeatError"></span></label>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        {{-- !Personal Info End --}}

                                        {{-- todo:Account Info Start --}}
                                        <div class="col-lg-6 bg-indigo" style="color: #3D464D !important;">
                                            <div class="p-5 ml-lg-4">
                                                <h3 class="fw-normal mb-5">Address Details</h3>
                                                <div class="mb-4 pb-2 " style="width: 80%;">
                                                    <div class="form-outline form-white">
                                                        <input type="number" id="streetNbr" name="streetNbr"
                                                            class="form-control form-control-lg" autocomplete="off" />
                                                        <label class="form-label" for="streetNbr">Street Number
                                                            <span class="text-danger error_message"
                                                                id="streetError"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="dropdown-group">
                                                    <select id="Country" size="1" name="country"
                                                        style="width:100% !important">
                                                        <option value="" selected="selected">-- Select Country --
                                                        </option>
                                                    </select>
                                                    <div class="text-danger error_message mb-4" id="countryError"></div>

                                                    <select id="State" size="1">
                                                        <option value="" selected="selected">-- Select State --
                                                        </option>
                                                    </select>
                                                    <div class="text-danger error_message mb-4" id="stateError"></div>

                                                    <select id="City" size="1">
                                                        <option value="" selected="selected">-- Select City --
                                                        </option>
                                                    </select>
                                                    <div class="text-danger error_message mb-4" id="cityError"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col"></div>
                                                    <div class="col"> <button type="submit" id="registerBtn"
                                                            class="btn btn-light btn-lg text-white"
                                                            style="background-color:#3D464D !important"
                                                            data-mdb-ripple-color="dark">Register</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{-- todo:Account Info End --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ URL::asset('Front/assets/js/country_city_state.js') }}"></script>
    <script src="{{ URL::asset('Back/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('Back/assets/js/jquery.toast.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#repeatPassword").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch").html("(Passwords do not match.)").addClass("text-danger");
                // $('#registerBtn').prop('disabled', true);

            } else {
                $("#CheckPasswordMatch").html(" ");
            }
        }

        $(document).ready(function() {
            $("#repeatPassword").keyup(checkPasswordMatch);
        });
    </script>

    {{-- ! check password Strength --}}
    <script>
        function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            var password = $('#password').val().trim();
            if (password.length < 6) {
                // $('#registerBtn').prop('disabled', true);
                $('#passwordError').removeClass();
                $('#passwordError').addClass('weak-password');
                $('#passwordError').html("Weak (should be at least 6 characters.)").addClass("text-danger");
            } else {
                if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                    $('#passwordError').removeClass();
                    $('#passwordError').addClass('strong-password');
                    $('#passwordError').html(" ").addClass("text-danger");
                    // $('#registerBtn').prop('disabled', false);

                } else {
                    // $('#registerBtn').prop('disabled', false);
                    $('#passwordError').removeClass();
                    $('#passwordError').addClass('medium-password');
                    $('#passwordError').html("Medium (should include alphabets, numbers and special characters.)").addClass(
                        "text-danger");
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#SignUpForm').on('submit', function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                var password = $('#password').val();
                var repeatPassword = $('#repeatPassword').val();
                var country = $('#Country').val();
                var state = $('#State').val();
                var city = $('#City').val();
                formData.append('country', country);
                formData.append('state', state);
                formData.append('city', city);

                $.ajax({
                    url: '{{ route('client.create') }}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        if (response.status == 'ExitsPhoneNbr') {
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
                                title: "Phone Number Already Exits !",
                            });
                            return;
                        }
                        if (response.status == 'passwordsNotEqual') {
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
                                title: "Password and Repeat Password Should be Same !!",
                            });
                            $('#repeatPassword').val("");
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
                                window.location.href = '{{ route('client.index') }}';
                            });
                        }
                    },
                    error: function(error) {
                        if (error) {
                            if (password === '' || repeatPassword === '') {
                                $('#passwordError').html('(required**)');
                                $('#repeatError').html('(required**)');
                            }
                            if (error.responseJSON.errors.birthDate)
                                $('#dateError').html('(required**)')
                            if (error.responseJSON.errors.city)
                                $('#cityError').html('(required**)')
                            if (error.responseJSON.errors.country)
                                $('#countryError').html('(required**)')
                            if (error.responseJSON.errors.fName)
                                $('#fNameError').html('(required**)')
                            if (error.responseJSON.errors.lName)
                                $('#lNameError').html('(required**)')
                            if (error.responseJSON.errors.password ===
                                'The password field is required.')
                                $('#passwordError').html('(required**)')
                            if (error.responseJSON.errors.RepeatPassword ===
                                'The repeat password field is required.')
                                $('#repeatError').html('(required**)')
                            if (error.responseJSON.errors.phoneNumber)
                                $('#phoneError').html('(required**)')
                            if (error.responseJSON.errors.state)
                                $('#stateError').html('(required**)')
                            if (error.responseJSON.errors.streetNbr)
                                $('#streetError').html('(required**)')
                            if (error.responseJSON.errors.email)
                                $('#emailError').html('(required**)')

                        }
                    }
                });

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function validatePhoneNumber(phoneNumber) {
                if (phoneNumber.length !== 8 || isNaN(phoneNumber)) {
                    $('#phoneError').html('(Phone number should consist of 8 numbers)');
                    // $('#registerBtn').prop('disabled', true);
                    return false;
                } else {
                    $('#phoneError').html('');
                    // $('#registerBtn').prop('disabled', false);
                    return true;
                }
            }

            $('#phoneNumber').on('keyup', function() {
                var phoneNumber = $(this).val();
                validatePhoneNumber(phoneNumber);
            })
        });
    </script>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
