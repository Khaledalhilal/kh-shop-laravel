@extends('back.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="shadow py-2 mb-2 bg-white">
            <h4 class=" mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard </a>>
                <a href="{{ route('products.index') }}" class="text-gray-800">Products</a> > <a
                    href="{{ route('products.create') }}" class="text-gray-800">New Products</a>
            </h4>
        </div>
        <div class="card shadow mb-4 " style="width:100%">
            <div class="card-body">
                <form id="addProductForm" enctype="multipart/form-data">
                    <div class="input-group " style="border-radius: 0px !important;">
                        <div class="input-group-prepend border-0" style="border-radius: 0px !important;">
                            <span class="input-group-text" style="width: 167px; color:black !important">Product Name</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Enter Product Name" name="productName"
                            autocomplete="off">
                    </div>
                    <div class="text-danger error_message mb-3" id="ProductameError"></div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 167px; color:black !important">Product Price</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Enter Product Price" name="price"
                            autocomplete="off">
                    </div>
                    <div class="text-danger error_message mb-3" id="priceError"></div>

                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 167px;color:black !important">Product
                                Description</span>
                        </div>
                        <textarea class="form-control" placeholder="Enter Product Description" name="description"></textarea>
                    </div>
                    <div class="text-danger error_message mb-3" id="descriptionError"></div>

                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" style="width: 167px;color:black !important">SubCategory
                                Name</label>
                        </div>
                        <select class="custom-select" name="category_id">
                            @foreach ($allSubCategories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-danger error_message mb-3" id="ProductameError"></div>

                    <div class="input-group " style="border-radius: 0px !important;">
                        <div class="input-group-prepend border-0" style="border-radius: 0px !important;">
                            <span class="input-group-text" style="width: 167px;color:black !important">Quantity</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Enter Quantity" name="quantity"
                            autocomplete="off">
                    </div>
                    <div class="text-danger error_message mb-3" id="quantityError"></div>
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" style="width: 167px;color:black !important">Brand Name</label>
                        </div>
                        <select class="custom-select" name="brand_id">
                            @foreach ($allBrands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger error_message mb-3" id="ProductameError"></span>

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
                                <select id="lunchBegins1" class="selectpicker" data-live-search="true" name="sizes[]"
                                    data-live-search-style="begins" title="Choose Size(s)" multiple>
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
                            <span class="input-group-text" style="color: black !important">Upload</span>
                        </div>
                        <div class="custom-file">

                            <input type="file" class="custom-file-input" name="productImages[]" id="inputGroupFile01"
                                multiple>
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="text-danger error_message mb-3" id="imagesError"></div>
                    <span style="color: black !important">is Featured ?</span>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="is_featured" value="1"
                            class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline125" name="is_featured" value="0"
                            class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline125">NO</label>
                    </div>

                    <div class="text-danger error_message mb-3" id="featuredError"></div>
                    <span style="color: black !important"> Gender:</span>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInlinee" name="gender" value="male"
                            class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInlinee">male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline ">
                        <input type="radio" id="customRadioInline2e" name="gender" value="female"
                            class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2e">female</label>
                    </div>
                    <div class="text-danger error_message mb-3" id="genderError"></div>
                    <div class="card-footer text-right">
                        <button type="reset" class="btn btn-danger border-0" style="border-radius: 0px">Cancel</button>
                        <button type="submit" class="btn "
                            style="background-color:#FFD333 !important;color:black;border-radius:0px">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function createOptions(number) {
            var options = [],
                _options;

            for (var i = 0; i < number; i++) {
                var option = '<option value="' + i + '">Option ' + i + '</option>';
                options.push(option);
            }

            _options = options.join('');

            $('#number')[0].innerHTML = _options;
            $('#number-multiple')[0].innerHTML = _options;

            $('#number2')[0].innerHTML = _options;
            $('#number2-multiple')[0].innerHTML = _options;
        }

        var mySelect = $('#first-disabled2');

        createOptions(4000);

        $('#special').on('click', function() {
            mySelect.find('option:selected').prop('disabled', true);
            mySelect.selectpicker('refresh');
        });

        $('#special2').on('click', function() {
            mySelect.find('option:disabled').prop('disabled', false);
            mySelect.selectpicker('refresh');
        });

        $('#basic2').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#addProductForm').on('submit', function(e) {
                e.preventDefault();
                $('.error_message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('products.store') }}',
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
                            $('#genderError').html(error.responseJSON.errors.gender)
                            $('#colorsError').html(error.responseJSON.errors.colors)
                            $('#sizesError').html(error.responseJSON.errors.sizes)
                            $('#imagesError').html(error.responseJSON.errors.productImages)
                            $('#quantityError').html(error.responseJSON.errors.quantity)


                        }
                    }
                });
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#addProductForm').on('submit', function(e) {
                e.preventDefault();
                $('.error_message').html('');

                var formData = new FormData(this);

                // Append image names to formData
                var images = $('#inputGroupFile01')[0].files;
                for (var i = 0; i < images.length; i++) {
                    formData.append('productImages[]', images[i].name);
                }

                $.ajax({
                    url: '{{ route('products.store') }}',
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
                            $('#ProductameError').html(error.responseJSON.errors.productName)
                            $('#priceError').html(error.responseJSON.errors.price)
                            $('#descriptionError').html(error.responseJSON.errors.description)
                            $('#featuredError').html(error.responseJSON.errors.is_featured)
                            $('#genderError').html(error.responseJSON.errors.gender)
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
