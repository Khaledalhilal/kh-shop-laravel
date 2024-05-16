@extends('Front.layouts.master')
@section('content')
    <style>
        .product-img {
            position: relative;
            overflow: hidden;
        }

        .product-img img {
            width: auto;
            height: 100%;
            object-fit: cover;
            /* Ensure the entire image is visible */
        }
    </style>
    {{-- <div class="mt-5">
        <h2>Session Data:</h2>
        @php
            $sessionData = session()->get('clientSession', []);
            dd($sessionData);
            $sessionId = session()->getId();
            dd($sessionId);
        @endphp
    </div> --}}
    <div id="search_result"></div>
    <div id="main-content">
        <link rel="stylesheet" href="{{ URL::asset('Front/assets/css/swiper.css') }}" />
        <img style="width: 100%; height:460px;" class="product-img position-relative overflow-hidden"
            src="{{ asset('Back/img/landingImage/' . $getAllGeneralInfo->landing_image) }}">
        {{-- todo:Categories Start  --}}
        <div class="container-fluid pt-5 hideOnSearch">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="bg-secondary pr-3">Categories</span>

            </h2>

            <div class="row px-xl-5 pb-3">
                @php
                    $counter = 0;
                @endphp
                @foreach ($getAllCategories as $k => $cat)
                    @php
                        $counter++;
                    @endphp
                    @if ($counter <= 8)
                        {{-- FFD333 --}}
                        <div class="col-lg-4 col-md-4 col-sm-6 pb-1 mb-2">
                            <div style="height: 350px !important; background-color:#3D464D">
                                <a class="text-decoration-none"
                                    href="{{ route('shopByCategory.allInfo', ['id' => $cat->id]) }}">

                                    <img src="{{ asset('Back/img/category/' . $cat->image) }}" alt=""
                                        class=" mb-2 position-relative overflow-hidden"
                                        style="height: 290px; width: 100%; background-size: cover; position: relative;">
                                    <div
                                        style="position: absolute; bottom: 0; left: 15%; text-align: center; padding: 20px;">
                                        <a href="{{ route('shopByCategory.allInfo', ['id' => $cat->id]) }}" class="h4"
                                            style="display: inline-block; margin-top: 20px; color: #FFD333 !important; font-weight: bold; text-decoration: none;">{{ $cat->name }}</a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        {{-- todo:Categories End  --}}

        {{-- ! Featured Products Start  --}}
        <div class="container-fluid pt-5 pb-3 hideOnSearch">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured
                    Products</span></h2>
            <div class="row px-xl-5">
                <div class="swiper mySwiper text-black ">
                    <div class="swiper-wrapper">
                        @foreach ($featuredProducts->chunk(4) as $chunk)
                            <div class="swiper-slide text-black">
                                <div class="row p-4">
                                    @foreach ($chunk as $k => $featureProd)
                                        <a class="wow fadeIn" href="{{ Route('detailsByProduct', $featureProd->id) }}"
                                            data-wow-delay="0.1s">
                                            <div class="col-lg-3 col-md-8 col-sm-12 pb-1 ">
                                                <div class="product-item bg-light mb-4">
                                                    <div class="product-img position-relative overflow-hidden">
                                                        <img class="img-fluid w-100"
                                                            src="{{ asset('Back/img/product/' . $featureProd->images->first()->image) }}"
                                                            alt=""
                                                            style="width: 100% !important; height:220px !important;">
                                                    </div>
                                                    <div class="text-center py-4">
                                                        <a class="h5 text-decoration-none text-truncate"
                                                            href="{{ Route('detailsByProduct', $featureProd->id) }}">{{ $featureProd->name }}</a>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h5>{{ $featureProd->brand->name }}</h5>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h6>${{ $featureProd->price }}</h6>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next bg-primary text-dark"></div>
                    <div class="swiper-button-prev bg-primary text-dark"></div>
                </div>
            </div>
        </div>
        {{-- ! Featured Products End  --}}




        {{-- ! Recent Products Start  --}}
        <div class="container-fluid pt-5 pb-3 hideOnSearch">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">RECENT
                    Products</span></h2>
            <div class="row px-xl-5">
                <div class="swiper mySwiper text-black">
                    <div class="swiper-wrapper">
                        @foreach ($recentProducts->chunk(4) as $chunk)
                            <div class="swiper-slide text-black">
                                <div class="row p-4">
                                    @foreach ($chunk as $featureProd)
                                        <a href="{{ Route('detailsByProduct', $featureProd->id) }}">
                                            <div class="col-lg-3 col-md-8 col-sm-12 pb-1 ">
                                                <div class="product-item bg-light mb-4">
                                                    <div
                                                        class="product-img position-relative overflow-hidden product-item bg-light">
                                                        <img class="img-fluid w-100 product-img position-relative overflow-hidden"
                                                            src="{{ asset('Back/img/product/' . $featureProd->images->first()->image) }}"
                                                            alt=""
                                                            style="width: 100% !important; height:220px !important;">
                                                    </div>
                                                    <div class="text-center py-4">
                                                        <a class="h5 text-decoration-none text-truncate"
                                                            href="{{ Route('detailsByProduct', $featureProd->id) }}">{{ $featureProd->name }}</a>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h5>{{ $featureProd->brand->name }}</h5>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h6>${{ $featureProd->price }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next bg-primary text-dark"></div>
                    <div class="swiper-button-prev bg-primary text-dark"></div>
                </div>
            </div>
        </div>
        {{-- ! Recent Products End  --}}

        {{-- ! Women's Products Start  --}}
        <div class="container-fluid pt-5 pb-3 hideOnSearch">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">WOMEN'S
                    Products</span></h2>
            <div class="row px-xl-5">
                <div class="swiper mySwiper text-black">
                    <div class="swiper-wrapper">
                        @foreach ($womensProduct->chunk(4) as $chunk)
                            <div class="swiper-slide text-black">
                                <div class="row p-4">
                                    @foreach ($chunk as $women)
                                        <a href="{{ Route('detailsByProduct', $women->id) }}">
                                            <div class="col-lg-3 col-md-8 col-sm-12 pb-1">
                                                <div class="product-item bg-light mb-4">
                                                    <div class="product-img position-relative overflow-hidden">
                                                        <img class="img-fluid w-100"
                                                            src="{{ asset('Back/img/product/' . $women->images->first()->image) }}"
                                                            alt=""
                                                            style="width: 100% !important; height:220px !important;">
                                                    </div>
                                                    <div class="text-center py-4">
                                                        <a class="h5 text-decoration-none text-truncate"
                                                            href="{{ Route('detailsByProduct', $women->id) }}">{{ $women->name }}</a>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h5>{{ $women->brand->name }}</h5>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h6>${{ $women->price }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next bg-primary text-dark"></div>
                    <div class="swiper-button-prev bg-primary text-dark"></div>
                </div>
            </div>
        </div>
        {{-- !  women's Products End  --}}

        {{-- ! Men's Products Start  --}}
        <div class="container-fluid pt-5 pb-3 hideOnSearch">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Men's
                    Products</span></h2>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel related-carousel">
                        @foreach ($mensProduct as $men)
                            <div class="product-item bg-light">
                                <div class="product-img position-relative overflow-hidden">
                                    <a href="{{ Route('detailsByProduct', $men->id) }}">
                                        <img class="img-fluid " style="width:100% !important; height:220px !important;"
                                            src="{{ asset('Back/img/product/' . $men->images->first()->image) }}"
                                            alt="">
                                </div>
                                <div class="text-center py-4">

                                    <a class="h6 text-decoration-none text-truncate"
                                        href="{{ Route('detailsByProduct', $men->id) }}">{{ $men->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${{ $men->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- !  Men's Products End  --}}


    </div>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ URL::asset('Front/assets/js/swiper.js') }}"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>


    {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'), // Get form action attribute
                    method: $(this).attr('method'), // Get form method attribute
                    data: formData, // Send serialized form data
                    success: function(response) {
                        $('#main-content').hide();
                        $('#search_result').html(response);
                    },
                });
            });
        });
    </script> --}}
@endsection
