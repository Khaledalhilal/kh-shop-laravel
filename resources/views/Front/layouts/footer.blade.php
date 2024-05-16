    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $getAllGeneralInfo->address }}
                </p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $getAllGeneralInfo->email }}</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $getAllGeneralInfo->phone_number }}
                </p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{ Route('home.index') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{ route('cart.all.info') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            
                        </div>
                    </div>
                    <div class="col-md-0 mb-5">
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Follow Us</h5>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-whatsapp"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fa fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    All Rights Reserved &copy;
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <a class="text-white text-end" href="{{ route('home.index') }}">Designed by <span
                        class="text-primary">Khaled Alhilal</span></a>
            </div>
        </div>
    </div>
    <!-- Footer End -->
