<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #343a40 !important;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ Route('back.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>

        <div class="sidebar-brand-text mx-3">KH-Shop <sup></sup></div>
    </a>
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('back.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ Route('back.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>
    <hr class="sidebar-divider my-0">


    <li class="nav-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('categories.index') }}">
            <i class="fa-solid fa-c"></i>
            <span>Categories</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('subCategories.index') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('subCategories.index') }}">
            <i class="fa-solid fa-s"></i>
            <span>Sub Categories</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('brands.index') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('brands.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Brands</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">

    <li
        class="nav-item {{ request()->routeIs('products.index') || request()->routeIs('products.create') || request()->routeIs('products.edit') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-brands fa-product-hunt"></i> <span>Products</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ Route('products.index') }}">Show Products</a>
                <a class="collapse-item" href="{{ Route('products.create') }}">Add Products</a>

            </div>
        </div>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->routeIs('coupons.index') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('coupons.index') }}">
            <i class="fa-solid fa-code"></i>
            <span>Coupon Codes</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('orders.index') }}">
            <i class="fa-brands fa-first-order-alt"></i>
            <span>Orders</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('general.index') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('general.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>General Info</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
