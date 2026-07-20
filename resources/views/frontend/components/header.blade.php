<!-- Header Start -->
<header class="shadow-sm bg-white sticky-top">
    <!-- Top Bar -->
    <div class="bg-dark text-white py-2">
        <div class="container d-flex justify-content-between">
            <div>
                <small>
                    <i class="fa-solid fa-truck-fast me-1"></i>
                    Free Shipping on Orders Above ₹999
                </small>
            </div>
            <div>
                <a href="#" class="text-white text-decoration-none me-3">
                    <i class="fa-solid fa-phone"></i> +91 9876543210
                </a>
                <a href="#" class="text-white text-decoration-none">
                    <i class="fa-solid fa-envelope"></i> support@example.com
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand fw-bold fs-3 text-primary" href="{{ route('home') }}">
                Shop<span class="text-dark">Ease</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">

                <!-- Search -->
                <form class="d-flex mx-auto w-50">
                    <input class="form-control me-2"
                           type="search"
                           placeholder="Search products...">
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <!-- Navigation Links -->
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="#"
                           data-bs-toggle="dropdown">
                            Categories
                        </a>

                        <ul class="dropdown-menu shadow border-0">
                            <li>
                                <a class="dropdown-item" href="#">
                                    Electronics
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Fashion
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Home & Living
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Beauty
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Wishlist -->
                    <li class="nav-item ms-2">
                        <a href="{{ route('wishlist.index') }}"
                           class="nav-link position-relative">
                            <i class="fa-regular fa-heart fa-lg"></i>

                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                2
                            </span>
                        </a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item ms-2">
                        <a href="{{ route('cart.index') }}"
                           class="nav-link position-relative">
                            <i class="fa-solid fa-cart-shopping fa-lg"></i>

                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                            </span>
                        </a>
                    </li>

                    <!-- User -->
                    @auth
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               data-bs-toggle="dropdown">
                                <i class="fa-solid fa-user"></i>
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('profile') }}">
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('orders.index') }}">
                                        My Orders
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}"
                                          method="POST">
                                        @csrf
                                        <button class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a href="{{ route('login') }}"
                               class="btn btn-outline-primary">
                                Login
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Header End -->