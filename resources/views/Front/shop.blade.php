@extends('Front.layouts.master')
@section('content')
    <style>
        .rs-container * {
            box-sizing: border-box;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        .rs-container {
            font-family: Arial, Helvetica, sans-serif;
            height: 45px;
            position: relative
        }

        .rs-container .rs-bg,
        .rs-container .rs-selected {
            background-color: #eee;
            border: 1px solid #ededed;
            height: 10px;
            left: 0;
            position: absolute;
            top: 5px;
            width: 100%;
            border-radius: 3px
        }

        .rs-container .rs-selected {
            background-color: #FFD333 !important;
            border: 1px solid #FFD333 !important;
            transition: all .2s linear;
            width: 0
        }

        .rs-container.disabled .rs-selected {
            background-color: #ccc;
            border-color: #bbb
        }

        .rs-container .rs-pointer {
            background-color: #fff;
            border: 1px solid #bbb;
            border-radius: 4px;
            cursor: pointer;
            height: 20px;
            left: -10px;
            position: absolute;
            top: 0;
            transition: all .2s linear;
            width: 30px;
            box-shadow: inset 0 0 1px #FFF, inset 0 1px 6px #ebebeb, 1px 1px 4px rgba(0, 0, 0, .1)
        }

        .rs-container.disabled .rs-pointer {
            border-color: #ccc;
            cursor: default
        }

        .rs-container .rs-pointer::after,
        .rs-container .rs-pointer::before {
            content: '';
            position: absolute;
            width: 1px;
            height: 9px;
            background-color: #ddd;
            left: 12px;
            top: 5px
        }

        .rs-container .rs-pointer::after {
            left: auto;
            right: 12px
        }

        .rs-container.sliding .rs-pointer,
        .rs-container.sliding .rs-selected {
            transition: none
        }

        .rs-container .rs-scale {
            left: 0;
            position: absolute;
            top: 5px;
            white-space: nowrap
        }

        .rs-container .rs-scale span {
            float: left;
            position: relative
        }

        .rs-container .rs-scale span::before {
            background-color: #ededed;
            content: "";
            height: 8px;
            left: 0;
            position: absolute;
            top: 10px;
            width: 1px
        }

        .rs-container.rs-noscale span::before {
            display: none
        }

        .rs-container.rs-noscale span:first-child::before,
        .rs-container.rs-noscale span:last-child::before {
            display: block
        }

        .rs-container .rs-scale span:last-child {
            margin-left: -1px;
            width: 0
        }

        .rs-container .rs-scale span ins {
            color: #333;
            display: inline-block;
            font-size: 12px;
            margin-top: 20px;
            text-decoration: none
        }

        .rs-container.disabled .rs-scale span ins {
            color: #999
        }

        .rs-tooltip {
            color: white;
            width: auto;
            min-width: 60px;
            height: 30px;
            background: #6C757D;
            border: 1px solid #FFD333 !important;
            border-radius: 3px;
            position: absolute;
            transform: translate(-50%, -35px);
            left: 13px;
            text-align: center;
            font-size: 13px;
            padding: 6px 10px 0
        }

        .rs-container.disabled .rs-tooltip {
            border-color: #ccc;
            color: #999
        }
    </style>
    <!-- Breadcrumb Start -->
    <div class="container-fluid mt-2">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <a class="breadcrumb-item text-dark active" href="#">Shop</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">

                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form id="colors_filter">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                        </div>
                        <?php
                        $distinctColors = collect([]);
                        ?>
                        @foreach ($allProducts as $product)
                            @foreach ($product['colors'] as $color)
                                @if (!$distinctColors->contains('color', $color['color']))
                                    <?php $distinctColors->push($color); ?>
                                    <div
                                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" name="color[]" value="{{ $color['color'] }}"
                                            id="color-{{ $color['id'] }}"
                                            class="color-label custom-control-input color-checkbox filter filterColor"
                                            @if (in_array($color['color'], $selectedColors)) checked @endif>
                                        <label class="custom-control-label"
                                            for="color-{{ $color['id'] }}">{{ $color['color'] }}</label>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach

                    </form>
                </div>

                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form id="sizes_filter">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                        </div>
                        <?php
                        $distinctSizes = collect([]);
                        ?>
                        @foreach ($allProducts as $product)
                            @foreach ($product['sizes'] as $size)
                                @if (!$distinctSizes->contains('size', $size['size']))
                                    <?php $distinctSizes->push($size); ?>
                                    <div
                                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" name="size[]" value="{{ $size['size'] }}"
                                            class="custom-control-input filter size-checkbox" id="size-{{ $size['id'] }}"
                                            @if (in_array($size['size'], $selectedSizes)) checked @endif>
                                        <label class="custom-control-label"
                                            for="size-{{ $size['id'] }}">{{ $size['size'] }}</label>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach

                    </form>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8 col-sm-12" style="margin-top: 40px">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right" id="sort">
                                        <a class="dropdown-item filter-by-price" id="min-price"
                                            data-sort="lowest_price">Lowest price</a>
                                        <a class="dropdown-item filter-by-price" id="max-price"
                                            data-sort="highest_price">Highest price</a>
                                    </div>
                                    {{-- <div>
                                        <input type="number" id="min-price" placeholder="Min price">
                                        <input type="number" id="max-price" placeholder="Max price">
                                        <button id="filter-by-price">Filter</button>
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                    @foreach ($allProducts as $key => $product)
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <a href="{{ route('detailsByProduct', $product['id']) }}">
                                        <img class="img-fluid"
                                            src="{{ asset('Back/img/product/' . $allProducts[$key]['images'][0]['image']) }}"
                                            style="width: 100% !important; height: 200px !important;">
                                    </a>

                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="">{{ $product['name'] }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${{ $product['price'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        {{ $allProducts->links() }}
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        $(document).ready(function() {
            $('.dropdown-item').click(function() {
                var sortOption = $(this).data('sort');
                if (sortOption === 'lowest_price' || sortOption === 'highest_price') {
                    filterProductsByPrice(sortOption);
                }
            });


            $('#sizes_filter, #colors_filter').click(function() {
                filterProducts();
            });
        });

        function filterProductsByPrice(sortOption) {
            var selectedSizes = getSelectedValues("input[name='size[]']:checked");
            var selectedColors = getSelectedValues("input[name='color[]']:checked");
            var cat_id = '{{ $cat_id }}';
            var url = '{{ route('shop.index', ['id' => ':cat_id']) }}';
            url = url.replace(':cat_id', cat_id);

            if (selectedColors == null || selectedColors.length === 0) {
                url += '?colors=All';
            } else {
                url += '?colors=' + selectedColors.join(',');
            }

            if (selectedSizes == null || selectedSizes.length === 0) {
                url += '&sizes=All';
            } else {
                url += '&sizes=' + selectedSizes.join(',');
            }

            url += '&sort=' + sortOption;

            window.location.href = url;
        }

        function getSelectedValues(selector) {
            var selectedValues = [];
            $(selector).each(function() {
                selectedValues.push($(this).val());
            });
            return selectedValues;
        }

        function filterProducts() {
            var selectedSizes = getSelectedValues("input[name='size[]']:checked");
            var selectedColors = getSelectedValues("input[name='color[]']:checked");
            var cat_id = '{{ $cat_id }}';
            var sortOption = getSortOption();
            var url = '{{ route('shop.index', ['id' => ':cat_id']) }}';
            url = url.replace(':cat_id', cat_id) + '?sort=' + sortOption;

            if (selectedColors == null || selectedColors.length === 0) {
                url += '&colors=All';
            } else {
                url += '&colors=' + selectedColors.join(',');
            }

            if (selectedSizes == null || selectedSizes.length === 0) {
                url += '&sizes=All';
            } else {
                url += '&sizes=' + selectedSizes.join(',');
            }

            window.location.href = url;
        }

        function getSortOption() {
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            return urlParams.get('sort') ||
            'default_sort_option';
        }
    </script>

@endsection
