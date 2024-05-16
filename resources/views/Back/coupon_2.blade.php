@extends('back.layouts.master')
@section('content')
    {{-- !Update Modal Start --}}
    <div class="modal fade" id="updateCoupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  text-white" style="background-color: #343a40 !important;">
                    <h5 class="modal-title" id="exampleModalLabel">Update Coupon Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form id="updateCouponForm" action="{{ route('coupons.update', $coupon->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="input-group" hidden>
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Coupon Code ID</span>
                            </div>
                            <input type="text" class="form-control" id="updateId" name="id"
                                placeholder="Enter Coupon Code Name" autocomplete="off" style="width:130px;">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">code</span>
                            </div>
                            <input type="text" class="form-control" id="updateCode" name="code"
                                placeholder="Enter Coupon Code Name" autocomplete="off" style="width:130px;">
                        </div>
                        <div class="text-danger error_message mb-3" id="codeError"></div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01" style="width:215px !important">User
                                    Name</label>
                            </div>
                            <select class="custom-select" id="user_id" name="user_id">
                                <option selected disabled>Choose User Name </option>
                                @foreach ($allUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger error_message mb-3" id="userIdError"></div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Discount Amount</span>
                            </div>
                            <input type="number" class="form-control" id="updateDiscountAmount" name="discountAmount"
                                placeholder="Enter Discount Amount" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="discountAmountError"></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Usage Count</span>
                            </div>
                            <input type="number" class="form-control" id="updateUsageCount" name="usageCount"
                                placeholder="Enter Usage Count" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="usageCountError"></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Minimum Purchase Amount</span>
                            </div>
                            <input type="number" class="form-control" id="updateMinimumPurchaseAmount"
                                name="minimumPurchaseAmount" placeholder="Enter Minimum Purchase Amount" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="minimumPurchaseAmountError"></div>


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Start Date</span>
                            </div>
                            <input type="date" class="form-control" id="updateStart_date" name="from_date"
                                placeholder="Enter Start Date For Coupon" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="from_dateError"></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:215px !important">Expiray Date</span>
                            </div>
                            <input type="date" class="form-control" id="updateExpiry_date" name="to_date"
                                placeholder="Enter Expiry Date For Coupon" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="to_dateError"></div>
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
                </form>
            </div>
        </div>
    </div>
    {{-- !Update Modal End --}}

    <div class="container-fluid">
        <div class="shadow py-2 mb-2 bg-white">
            <h4 class=" mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard
                </a>/ <a href="{{ route('coupons.index') }}" class="text-gray-800">Coupon-Code</a></h4>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="m-0 font-weight-bold text-primary">
                </span>
                <span class="m-0 font-weight-bold text-primary text-end py-3" style="">

                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center" style="color:#343a40;background-color: #FFD333;border-radius:0px !important;">
                                <th scope="col">Max Usage</th>
                                <th scope="col">Remained Usage</th>
                                <th scope="col">Minimum Purchase Amount</th>
                                <th scope="col">Is Active?</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $coupon->usageCount }}</td>
                                <td>
                                    @php
                                        $usage = $coupon->usageCount;
                                        $userUsageCount = $coupon->userUsageCount;
                                        $remained = $usage - $userUsageCount;
                                        echo $remained;

                                    @endphp </td>
                                <td>{{ $coupon->minimumPurchaseAmount }}$</td>
                                <td>
                                    @if ($coupon->isActive === 'yes')
                                        <a class="bg-success text-white p-2"
                                            style=" text-decoration:none;">
                                            Active
                                        </a>
                                    @else
                                        <a class="bg-danger text-white p-2"
                                            style="text-decoration:none;">
                                            Not Active
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a data-id="{{ $coupon->id }}" class="delete"
                                        style="text-decoration:none !important;">
                                        <button type="button" class="btn "
                                            style="background-color: transparent !important;">
                                            <i class="fa-solid fa-trash" style="color: red; margin-right: 0px;"
                                                title="Delete"></i>
                                        </button>
                                    </a>
                                    <button type="button" class="btn edit"
                                        style="background-color: transparent !important;" code="{{ $coupon->code }}"
                                        coupon_id="{{ $coupon->id }}" user_id="{{ $coupon->user_id }}"
                                        discountAmount="{{ $coupon->discountAmount }}"
                                        usageCount="{{ $coupon->usageCount }}"
                                        userUsageCount="{{ $coupon->userUsageCount }}"
                                        isActive="{{ $coupon->isActive }}" from_date="{{ $coupon->from_date }}"
                                        to_date="{{ $coupon->to_date }}"
                                        minimumPurchaseAmount="{{ $coupon->minimumPurchaseAmount }}" data-toggle="modal"
                                        data-target="#updateCoupon">
                                        <i class=" fa-solid fa-pen-to-square" style="color: green;" title="Update"></i>
                                    </button>
                                </td>
                            </tr>
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
                            url: '/coupons/' + id,
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: response.message,
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href =
                                            '{{ route('coupons.index') }}';
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
                var id = $(this).attr('coupon_id');
                var code = $(this).attr('code');
                var user_id = $(this).attr('user_id');
                var discountAmount = $(this).attr('discountAmount');
                var usageCount = $(this).attr('usageCount');
                var minimumPurchaseAmount = $(this).attr('minimumPurchaseAmount');
                var isActive = $(this).attr('isActive');
                var from_date = $(this).attr('from_date');
                var to_date = $(this).attr('to_date');
                //////////////////////////////////////////////////////
                $('#updateCode').val(code);
                $('#updateId').val(id);
                $('#user_id').val(user_id);
                $('#updateDiscountAmount').val(discountAmount);
                $('#updateUsageCount').val(usageCount);
                $('#updateMinimumPurchaseAmount').val(minimumPurchaseAmount);
                $('#updateExpiry_date').val(isActive);
                $('#updateStart_date').val(from_date);
                $('#updateExpiry_date').val(to_date);
                if (isActive === 'yes') {
                    $('#yes').prop('checked', true);
                } else {
                    $('#no').prop('checked', true);
                }


            });

            $('#updateCouponForm').submit(function(e) {
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
                        if (error.responseJSON.errors.code)
                            $('#codeError').html(error.responseJSON.errors.code);
                        ///////////////
                        if (error.responseJSON.errors.discountAmount)
                            $('#discountAmountError').html(error.responseJSON.errors.discountAmount);
                        ///////////////
                        if (error.responseJSON.errors.expiry_date)
                            $('#to_dateError').html(error.responseJSON.errors.expiry_date);
                        ///////////////
                        if (error.responseJSON.errors.minimumPurchaseAmount)
                            $('#minimumPurchaseAmountError').html(error.responseJSON.errors.minimumPurchaseAmount);
                        ///////////////
                        if (error.responseJSON.errors.start_date)
                            $('#from_dateError').html(error.responseJSON.errors.start_date);
                        ///////////////
                        if (error.responseJSON.errors.usageCount)
                            $('#usageCountError').html(error.responseJSON.errors.usageCount);
                        ///////////////
                    }
                });
            });
        });
    </script>
@endsection
