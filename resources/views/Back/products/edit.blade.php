@extends('back.layouts.master')
@section('content')
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('Front/assets/css/swiper.css') }}" />

    <div class="container-fluid">
        <div class="h3 mb-2 text-gray-800 mb-2 bg-white shadow p-2">
            <a href="{{ Route('products.index') }}" class="text-gray-800">Products</a>>
            <a class="text-dark" href="" @disabled(true)>Edit Product</a>
        </div>
        <div class="row">
            <div class="card shadow mb-4 " style="width:100%">
                <div class="card-body">
                    <form id="updateProductForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="input-group " hidden>
                            <div class="input-group-prepend">
                                <span class="input-group-text">Product ID</span>
                            </div>
                            <input value="{{ $allSpecificProducts->id }}" type="text" id="productIdInput"
                                class="form-control" placeholder="Enter Product ID" name="id" autocomplete="off">
                        </div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px;">Product Name</span>
                            </div>
                            <input value="{{ $allSpecificProducts->name }}" type="text" class="form-control"
                                placeholder="Enter Product Name" name="productName" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="ProductameError"></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px;">Product Price</span>
                            </div>
                            <input type="number" value="{{ $allSpecificProducts->price }}" class="form-control"
                                placeholder="Enter Product Price" name="price" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="priceError"></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px;">Quantity</span>
                            </div>
                            <input type="number" value="{{ $allSpecificProducts->quantity }}" class="form-control"
                                placeholder="Enter Quantity" name="quantity" autocomplete="off">
                        </div>
                        <div class="text-danger error_message mb-3" id="quantityError"></div>

                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px;">Product Description</span>
                            </div>
                            <textarea class="form-control" placeholder="Enter Product Description" name="description">{{ $allSpecificProducts->description }}</textarea>
                        </div>
                        <div class="text-danger error_message mb-3" id="descriptionError"></div>

                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" style="width: 160px;">SubCategory Name</label>
                            </div>
                            <select class="custom-select" name="category_id">
                                <option value="{{ $allSpecificProducts->subCategory->id }}">
                                    {{ $allSpecificProducts->subCategory->name }}</option>
                                @foreach ($allSubCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger error_message mb-3" id="subError"></div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" style="width: 160px;">Brand Name</label>
                            </div>
                            <select class="custom-select" name="brand_id">
                                <option value="{{ $allSpecificProducts->brand->id }}">
                                    {{ $allSpecificProducts->brand->name }}</option>
                                @foreach ($allBrands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger error_message mb-3" id="brandError"></div>

                        <div class="row d-flex mt-3">
                            {{-- !Color start --}}
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="col-lg-2 control-label h5" style="color: black !important"
                                    for="lunchBegins">colors</label>
                                <div class="col-lg-10">
                                    <select id="lunchBegins" class="selectpicker" data-live-search="true" name="colors[]"
                                        data-live-search-style="begins" title="Choose Color(s)" multiple>
                                        <option value="pink">Pink</option>
                                        <option value="blue">Blue</option>
                                        <option value="black">Black</option>
                                        <option value="red">Red</option>
                                        <option value="green">Green</option>
                                        <option value="yellow">Yellow</option>
                                        <option value="orange">Orange</option>
                                        <option value="purple">Purple</option>
                                        <option value="brown">Brown</option>
                                        <option value="white">White</option>
                                        <option value="gray">Gray</option>
                                        <option value="cyan">Cyan</option>
                                        <option value="magenta">Magenta</option>
                                        <option value="navy">Navy</option>
                                        <option value="teal">Teal</option>
                                        <option value="lime">Lime</option>
                                        <option value="maroon">Maroon</option>
                                        <option value="olive">Olive</option>
                                        <option value="indigo">Indigo</option>
                                        <option value="violet">Violet</option>
                                        <option value="turquoise">Turquoise</option>
                                        <option value="silver">Silver</option>
                                        <option value="gold">Gold</option>
                                        <option value="bronze">Bronze</option>
                                    </select>
                                </div>
                                <div class="text-danger error_message mb-3 ml-3" id="colorsError"></div>
                            </div>
                            {{-- !Color End --}}
                            {{-- !Sizes start --}}
                            <div class="form-group col-6">
                                <label class="col-lg-2 control-label h5" style="color: black !important"
                                    for="lunchBegins1">Sizes</label>
                                <div class="col-lg-10">
                                    <select id="lunchBegins1" class="selectpicker" data-live-search="true"
                                        name="sizes[]" data-live-search-style="begins" title="Choose Size(s)" multiple>
                                        <option value="m">Medium</option>
                                        <option value="s">Small</option>
                                        <option value="xl">XLarge</option>
                                        <option value="xs">Extra Small</option>
                                        <option value="l">Large</option>
                                        <option value="xxl">XXLarge</option>
                                        <option value="3xl">3XLarge</option>
                                        <option value="4xl">4XLarge</option>
                                        <option value="5xl">5XLarge</option>
                                        <option value="6xl">6XLarge</option>
                                        <option value="7xl">7XLarge</option>
                                        <option value="8xl">8XLarge</option>
                                    </select>
                                </div>
                                <div class="text-danger error_message mb-3 ml-3" id="sizesError"></div>
                            </div>
                            {{-- !Sizes End --}}
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px;">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="productImages[]"
                                    id="inputGroupFile01" multiple>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <div class="text-danger error_message mb-3" id="imagesError"></div>


                        @if ($allSpecificProducts->is_featured == 1)
                            <span class="mr-2">
                                is Featured ?
                            </span>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1"checked name="is_featured" value="1"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" id="customRadioInline2" name="is_featured" value="0"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">No</label>
                            </div>
                        @endif
                        @if ($allSpecificProducts->is_featured == 0)
                            <span class="mr-2">
                                is Featured ?
                            </span>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1"checked name="is_featured" value="1"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" id="customRadioInline2" name="is_featured" value="0"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">No</label>
                            </div>
                        @endif
                        <div class="text-danger error_message mb-3" id="featuredError"></div>

                        @if ($allSpecificProducts->gender === 'male')
                            <span style="margin-right: 40px;">
                                Gender:
                            </span>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="male-1"checked name="gender" value="male"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="male-1">male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" id="female-1" name="gender" value="female"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="female-1">female</label>
                            </div>
                        @endif
                        @if ($allSpecificProducts->gender === 'female')
                            <span style="margin-right: 40px;">
                                Gender:
                            </span>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="male-1" name="gender" value="male"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="male-1">male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" id="female-1" checked name="gender" value="female"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="female-1">female</label>
                            </div>
                        @endif
                        <div class="text-danger error_message mb-3" id="featuredError"></div>


                        <div class="row m-4" style="margin-bottom: 30px !important">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @foreach ($allSpecificProducts->images->chunk(4) as $chunk)
                                        <div class="swiper-slide">
                                            <div class="row mb-4">
                                                @foreach ($chunk as $img)
                                                    <div class="col-md-3">
                                                        <div class="card p-4"
                                                            style="width: 15rem;height:120%; margin:0px;border:0px">
                                                            <img src="{{ asset('Back/img/product/' . $img->image) }}"
                                                                width="140px" height='140px'>
                                                            <div class="card-body">
                                                                @if (count($chunk) > 1)
                                                                    <button
                                                                        class="btn btn-danger text-center deleteImageBtn " style="margin-bottom: 100px !important"
                                                                        data-id="{{ $img->id }}">
                                                                        Delete
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        <div class="card-footer text-right mt-4">
                            <button type="reset" class="btn btn-danger p-2" style="width: 100px;">Cancel</button>
                            <button type="submit" class="btn btn-primary p-2" style="width: 100px;">Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ URL::asset('Front/assets/js/swiper.js') }}"></script>
    {{-- ! to select colors and sizes Start --}}
    <script>
        $(document).ready(function() {
            // Retrieve the colors and sizes data from the JSON object
            var colors = {!! json_encode($allSpecificProducts->colors->pluck('color')) !!};
            var sizes = {!! json_encode($allSpecificProducts->sizes->pluck('size')) !!};

            // Set selected options for colors
            $('#lunchBegins').val(colors);
            $('#lunchBegins').selectpicker('refresh');

            // Set selected options for sizes
            $('#lunchBegins1').val(sizes);
            $('#lunchBegins1').selectpicker('refresh');
        });
    </script>
    {{-- ! to select colors and sizes End --}}

    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script>
        $(document).ready(function() {
            var productId = $('#productIdInput').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.deleteImageBtn').on('click', function(e) {
                e.preventDefault();
                var imageId = $(this).data('id');

                $.ajax({
                    url: '/products/image/' + imageId,
                    method: 'DELETE',
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
                                window.location.href =
                                    '{{ route('products.edit', ':id') }}'.replace(
                                        ':id', productId);
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
                                window.location.href =
                                    '{{ route('products.edit', ':id') }}'.replace(
                                        ':id', productId);
                            });
                        }


                    },
                    error: function(error) {
                        if (error) {
                            // console.log();
                            $('#nameError').html(error.responseJSON.errors.name)
                            if (error.responseJSON.errors.my_work)
                                $('#imageError').html('Image field is required')
                        }
                    }
                });
            });

            $('#updateProductForm').on('submit', function(e) {
                //  alert();
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('products.update', $allSpecificProducts->id) }}',
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
                                window.location.href = '{{ route('products.index') }}';
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
                            // console.log();
                            $('#ProductameError').html(error.responseJSON.errors.productName)
                            $('#priceError').html(error.responseJSON.errors.price)
                            $('#descriptionError').html(error.responseJSON.errors.description)
                            $('#featuredError').html(error.responseJSON.errors.is_featured)
                            $('#colorsError').html(error.responseJSON.errors.colors)
                            $('#sizesError').html(error.responseJSON.errors.sizes)
                            $('#imagesError').html(error.responseJSON.errors.productImages)
                            $('#quantityError').html(error.responseJSON.errors.quantity)


                        }
                    }
                });
            });


        });
    </script>
@endsection
