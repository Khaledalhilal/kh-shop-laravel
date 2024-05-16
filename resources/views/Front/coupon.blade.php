@extends('Front.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid mt-4">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <span class="breadcrumb-item active">Coupon </span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    {{-- <div class="mt-5">
        <h2>Session Data:</h2>
        @php
            $sessionData = session()->get('clientSession', []);
            dd($sessionData);
        @endphp
    </div> --}}

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Code</th>
                            <th># Of allowed Times</th>
                            <th>Used</th>
                            <th>Min Purchase Amount</th>
                            <th>Discount</th>
                            <th>Is Active</th>
                            <th>From-to-Date</th>
                        </tr>
                    </thead>
                    @if ($allCoupons)
                        <tbody class="align-middle">
                            <tr>
                                <td class="align-middle">{{ $allCoupons->code }}</td>
                                <td class="align-middle price">{{ $allCoupons->usageCount }}</td>
                                <td class="align-middle price">{{ $allCoupons->userUsageCount }}</td>
                                <td class="align-middle price">{{ $allCoupons->minimumPurchaseAmount }}</td>
                                <td class="align-middle price">%{{ $allCoupons->discountAmount }}</td>
                                <td class="align-middle price">{{ $allCoupons->isActive }}</td>
                                <td class="align-middle total">{{ $allCoupons->from_date }} - {{ $allCoupons->to_date }}
                                </td>
                            </tr>
                        </tbody>
                    @else
                        <tbody class="align-middle">
                            <tr>
                                <td colspan="7" class="text-bold text-danger">No coupons available</td>
                            </tr>
                        </tbody>
                    @endif

                </table>
            </div>

        </div>
    </div>
@endsection
