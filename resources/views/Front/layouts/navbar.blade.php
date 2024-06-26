<!-- Topbar Start -->
<div class="container-fluid ">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                {{-- <div class="btn-group mx-2">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">$</button>
                    </div>
                </div> --}}
                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                        data-toggle="dropdown">EN</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">EN</button>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My
                        Account</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        {{-- <button class="dropdown-item" type="button">Sign in</button> --}}

                        @php
                            $clientLogin = session()->get('clientSession');
                        @endphp
                        @if ($clientLogin)
                            {{-- <a href="{{ route('client.index') }}" class="btn text-dark ms-2"><i
                                    class="fa-regular fa-address-book" style="margin-right: 5px;"></i> Address</a> --}}
                            <a href="{{ route('profile.index') }}" class="btn text-dark ms-2"><i
                                    class="fa-solid fa-user" style="margin-right: 10px;"></i>profile</a>
                            <form action="{{ route('coupon.show') }}" method="GET">
                                {{-- @method('POST') --}}
                                {{-- @csrf --}}
                                <button type="submit" class="btn text-dark ms-2 mb-0"><i
                                        class=" fa-solid fa-check-to-slot"
                                        style="margin-right: 5px;"></i>Coupons</button>
                            </form>

                            <hr>

                            @php
                                $name = session()->get('clientSession.name');
                                $id = session()->get('clientSession.id');
                            @endphp
                            <form action="{{ route('client.logout', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </form>
                            {{-- <a href="{{ route('client.logout') }}" class="btn text-dark ms-2 mt-0">


                                <i class="fa-solid fa-arrow-right-from-bracket" style="margin-right: 5px;"></i>
                                logout</a> --}}
                        @else
                            <a href="{{ route('client.index') }}" class="btn text-dark ms-2">Sign in</a>
                            <a href="{{ route('client.signUp') }}" class="btn text-dark ms-2">Sign Up</a>
                        @endif


                    </div>
                </div>

            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="{{ route('wishlist.index') }}" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                        style="padding-bottom: 2px;">{{ $wishlistCount }}</span>
                </a>
                <a href="{{ route('cart.all.info') }}" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">
                        @php
                            $cartCounter = session()->get('cartCounter');
                        @endphp
                        @if ($cartCounter)
                            {{ $cartCounter }}
                        @else
                            0
                        @endif
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="{{ route('home.index') }}" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">KH</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="{{ route('search.index') }}" method="GET" id="search-form">
                <div class="input-group">
                    <input type="text" onfocus="this.value=''" class="form-control" placeholder="Search for products"
                        name="search" id="search1">
                    <div class="input-group-append">
                        <a class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                </div>
            </form>
            {{-- <div id="search_results"></div> --}}
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">{{ $getAllGeneralInfo->phone_number }}</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid bg-dark ">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse  position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    @foreach ($getAllCategories as $cat)
                        <a href="{{ Route('shopByCategory.allInfo', $cat->id) }}"
                            class="nav-item nav-link">{{ $cat->name }}</a>
                        {{-- @endif --}}
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Mk</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ Route('home.index') }}" class="nav-item nav-link active">Home</a>
                        {{-- <a href="{{ Route('shop.index') }}" class="nav-item nav-link ">Shop</a> --}}

                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="{{ route('wishlist.index') }}" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span id="wishListCounter"
                                class="badge text-secondary border border-secondary rounded-circle"
                                style="padding-bottom: 2px;">{{ $wishlistCount }}</span>
                        </a>
                        <a href="{{ route('cart.all.info') }}" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span id="cartCounter" class="badge text-secondary border border-secondary rounded-circle"
                                style="padding-bottom: 2px;">
                                @php
                                    $cartCounter = session()->get('cartCounter');
                                @endphp
                                @if ($cartCounter)
                                    {{ $cartCounter }}
                                @else
                                    0
                                @endif
                            </span>
                        </a>


                        {{-- {{ dd(session()->get('cartCounter')) }} --}}
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
