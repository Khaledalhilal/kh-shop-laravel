@extends('back.layouts.master')
@section('content')
    {{-- !Add Modal Start  --}}
    <div class="modal fade" id="addCoupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form enctype="multipart/form-data" id="addCouponForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header  text-white" style="background-color: #343a40 !important;">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New Coupon Code</h5>
                        <button class="close" type="button btn-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Code</span>
                            </div>
                            <input type="text" class="form-control" id="name" name="code"
                                placeholder="Enter Code" autocomplete="off" style="width:130px;">
                        </div>
                        <div class="text-danger error_message mb-3" id="codeError"></div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01" style="width:215px !important">User
                                    Name</label>
                            </div>
                            <select class="custom-select" id="user_id" name="user_id">
                                <option selected disabled>Choose User Name</option>
                                @foreach ($allUsers as $user)
                                    <option value="{{ $user->id }}" @if (in_array($user->id, $existingUserIds)) disabled @endif>
                                        {{ $user->name }}
                                        @if (in_array($user->id, $existingUserIds))
                                            <span style="color: red !important">(alread Added)</span>
                                        @endif
                                    </option>
                                @endforeach
                            </select>


                        </div>
                        <div class="text-danger error_message mb-3" id="userError"></div>



                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Discount %</span>
                            </div>
                            <input type="number" class="form-control" id="discount" name="discount"
                                placeholder="Enter Discount Quantity" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="discountAmountError"></div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Usage Count</span>
                            </div>
                            <input type="number" class="form-control" id="discount" name="usageCount"
                                placeholder="Enter How many times can use the code" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="usageCountError"></div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Minimum Purchase Amount</span>
                            </div>
                            <input type="number" class="form-control" id="minPurchaseAmt" name="minPurchaseAmt"
                                placeholder="Enter Minumun Purchase Amount" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="minPurchaseAmtError"></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Start Date</span>
                            </div>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                placeholder="Enter Start Date For Coupon" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="startError"></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Expiray Date</span>
                            </div>
                            <input type="date" class="form-control" id="expiryError" name="expiry_date"
                                placeholder="Enter Expiry Date For Coupon" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="expiry_date"></div>
                        <span style="margin-right: 40px;">
                            Is Active?
                        </span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="yes" name="isActive" value="yes"
                                class="custom-control-input">
                            <label class="custom-control-label" for="yes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="no" name="isActive" value="no"
                                class="custom-control-input">
                            <label class="custom-control-label" for="no">No</label>
                        </div>
                        <div class="text-danger error_message mb-3" id="isActiveError"></div>

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
    {{-- !Add Modal End  --}}


    <div class="container-fluid">
        <div class="shadow py-2 mb-2 bg-white">
            <h4 class=" mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard
                </a>/ <a href="{{ route('coupons.index') }}" class="text-gray-800">Coupon-Code</a></h4>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="m-0 font-weight-bold text-primary">
                </span>
                <span class="m-0 font-weight-bold text-primary text-end">
                    <button class="btn p-2" style="background-color:#FFD333 !important;color:black;border-radius:0px"
                        data-toggle="modal" data-target="#addCoupon"><i class="fa-regular fa-square-plus"
                            style="font-size: 18px"></i> Add Coupon-Code</button>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center"
                                style="color:#343a40;background-color: #FFD333;border-radius:0px !important;">
                                <th scope="col">code</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allCoupons as $key => $coupon)
                                <tr class="text-center">
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->users->name }}</td>
                                    <td>{{ $coupon->discountAmount }}%</td>
                                    <td>{{ $coupon->from_date }}</td>
                                    <td>{{ $coupon->to_date }}</td>
                                    <td>
                                        <form action="{{ route('coupons.show', $coupon->id) }}" method="post">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="btn"
                                                style="background-color: transparent !important;">
                                                <i class=" fa-solid fa-arrow-right" style="color: green;"
                                                    title="Next"></i>
                                            </button>
                                        </form>
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
            // alert();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#addCouponForm').on('submit', function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('coupons.store') }}',
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
                            });
                        }
                    },
                    error: function(error) {
                        if (error) {
                            if (error.responseJSON.errors.code) {
                                $('#codeError').html(error.responseJSON.errors.code);
                            }


                            if (error.responseJSON.errors.discount) {
                                $('#discountAmountError').html(error.responseJSON.errors
                                    .discountAmount);
                            }


                            if (error.responseJSON.errors.expiry_date) {
                                $('#expiryError').html(error.responseJSON.errors.expiry_date);
                            }


                            if (error.responseJSON.errors.minPurchaseAmt) {
                                $('#minPurchaseAmtError').html(error.responseJSON.errors
                                    .minimumPurchaseAmount);
                            }


                            if (error.responseJSON.errors.start_date) {
                                $('#startError').html(error.responseJSON.errors.start_date);
                            }


                            if (error.responseJSON.errors.usageCount) {
                                $('#usageCountError').html(error.responseJSON.errors
                                    .usageCount);
                            }


                            if (error.responseJSON.errors.isActive) {
                                $('#isActiveError').html(error.responseJSON.errors.usageCount);
                            }


                            if (error.responseJSON.errors.user_id) {
                                $('#userError').html(error.responseJSON.errors.usageCount);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
