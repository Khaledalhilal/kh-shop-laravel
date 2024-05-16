@extends('back.layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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

        .swiper-pagination-bullet {
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            color: #000;
            opacity: 1;
            background: rgba(0, 0, 0, 0.2);
        }

        .swiper-pagination-bullet-active {
            color: #fff;
            background: #007aff;
        }

        .swiper-image {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
        }
    </style>

    {{-- <div class="container-fluid"> --}}
    <div class="shadow py-2 mb-2 bg-white">
        <h4 class=" mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}" class="text-gray-800">Dashboard </a>> <a
                href="{{ route('products.index') }}" class="text-gray-800">Products</a> > <a class="text-gray-800"
                @disabled(true)>Product Detials</a></h4>
    </div>
    <div class="container-fluid pb-5 bg-white ">
        <div class="row px-xl-5 ">
            <div class="col-lg-5 mb-30 mt-4">
                <div class="swiper mySwiper" style="height:75% !important;">
                    <div class="swiper-wrapper">
                        @foreach ($allProducts->images as $item)
                            <div class="swiper-slide">
                                <img class="img-fluid swiper-image" src="{{ asset('Back/img/product/' . $item->image) }}"
                                    alt="">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>


            <div class="col-lg-7 h-auto mb-30 mt-4">
                <div class="h-100  p-30">
                    <h3><span style="color:black;">Product Name:</span> {{ $allProducts->name }}</h3>
                    <h3 class="font-weight-semi-bold mb-4"style="color:black;">Price: ${{ $allProducts->price }}</h3>
                    <p class="mb-4 "><span class="h3" style="color:black;">Description</span> <br>
                        {{ $allProducts->description }}</p>
                    <div class="d-flex mb-4">
                        <strong class="text-bold mr-3" style="color:black !important;">Sizes:</strong>
                            @foreach ($allProducts->sizes as $sizes)
                                <span class="mr-2">{{ $sizes->size }}</span>
                            @endforeach
                    </div>

                    <div class="d-flex mb-4">
                        <strong class="text-bold mr-3" style="color:black !important;">Colors:</strong>
                        @foreach ($allProducts->colors as $colors)
                            <span class="mr-2">
                                {{ $colors->color }}
                            </span>
                        @endforeach
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-bold mr-3" style="color:black !important;">Gender:</strong>
                        {{ $allProducts->gender }}
                    </div>

                    <div class="d-flex align-items-center  pt-2 mb-4">
                        <div class=" mr-3">
                            <div class="d-flex ">
                                <strong class="text-bold mr-3" style="color:black !important;">SubCategory:</strong>
                                {{ optional($allProducts->subCategory)->name }}
                            </div>
                        </div>

                        <div class=" mr-3">
                            <div class="d-flex ">
                                <strong class="text-bold mr-3" style="color:black !important;">Brand:</strong>
                                {{ optional($allProducts->brand)->name }}
                            </div>
                        </div>

                    </div>

                    <div class="d-flex align-items-center  pt-2 mb-4">
                        <div class=" mr-3">
                            <div class="d-flex ">
                                <strong class="text-bold mr-3" style="color:black !important;">Quantity:</strong>
                                {{ $allProducts->quantity }}
                            </div>
                        </div>

                        <div class=" mr-3">
                            <div class="d-flex ">
                                <strong class="text-bold mr-3" style="color:black !important;">Available Quantity:</strong>
                            {{ $allProducts->remained_quantity }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '">' + (index + 1) + "</span>";
                },
            },
        });
    </script>
@endsection
