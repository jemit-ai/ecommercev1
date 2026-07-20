
<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">

            {{-- Left Content --}}
            <div class="col-lg-6">
                <span class="badge bg-primary px-3 py-2 mb-3">
                    New Collection 2026
                </span>

                <h1 class="display-4 fw-bold mb-4">
                    Discover Premium Products
                    <span class="text-primary">For Your Lifestyle</span>
                </h1>

                <p class="lead text-muted mb-4">
                    Shop the latest trends in fashion, electronics, home décor,
                    and accessories. Enjoy exclusive deals, fast delivery, and
                    secure payments.
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href=""
                       class="btn btn-primary btn-lg px-4">
                        Shop Now
                    </a>

                    <a href=""
                       class="btn btn-outline-dark btn-lg px-4">
                        View Deals
                    </a>
                </div>

                {{-- Hero Stats --}}
                <div class="row mt-5">
                    <div class="col-4">
                        <h3 class="fw-bold text-primary">50K+</h3>
                        <p class="text-muted mb-0">Customers</p>
                    </div>

                    <div class="col-4">
                        <h3 class="fw-bold text-primary">10K+</h3>
                        <p class="text-muted mb-0">Products</p>
                    </div>

                    <div class="col-4">
                        <h3 class="fw-bold text-primary">4.9★</h3>
                        <p class="text-muted mb-0">Rating</p>
                    </div>
                </div>
            </div>

            {{-- Right Content --}}
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="position-relative">

                    {{-- Main Image --}}
                    <img src="{{ asset('images/hero-product.png') }}"
                         alt="Hero Product"
                         class="img-fluid rounded-4 shadow-lg">

                    {{-- Floating Card 1 --}}
                    <div class="card shadow border-0 position-absolute top-0 start-0 translate-middle p-2"
                         style="width:180px;">
                        <div class="card-body p-2">
                            <small class="text-muted">Special Offer</small>
                            <h6 class="mb-1">Up to 40% OFF</h6>
                            <span class="text-success fw-bold">
                                Limited Time
                            </span>
                        </div>
                    </div>

                    {{-- Floating Card 2 --}}
                    <div class="card shadow border-0 position-absolute bottom-0 end-0 p-2"
                         style="width:190px;">
                        <div class="card-body p-2">
                            <small class="text-muted">
                                <i class="fas fa-truck text-primary"></i>
                                Free Delivery
                            </small>

                            <h6 class="mb-0 mt-1">
                                Delivered within 24 Hours
                            </h6>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- Features Bar --}}
<section class="bg-white py-4 border-top border-bottom">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-3 mb-3 mb-md-0">
                <i class="fas fa-shipping-fast fa-2x text-primary mb-2"></i>
                <h6 class="mb-1">Free Shipping</h6>
                <small class="text-muted">
                    On all orders over ₹1,499
                </small>
            </div>

            <div class="col-md-3 mb-3 mb-md-0">
                <i class="fas fa-undo fa-2x text-primary mb-2"></i>
                <h6 class="mb-1">Easy Returns</h6>
                <small class="text-muted">
                    7-Day Return Policy
                </small>
            </div>

            <div class="col-md-3 mb-3 mb-md-0">
                <i class="fas fa-lock fa-2x text-primary mb-2"></i>
                <h6 class="mb-1">Secure Payments</h6>
                <small class="text-muted">
                    100% Secure Checkout
                </small>
            </div>

            <div class="col-md-3">
                <i class="fas fa-headset fa-2x text-primary mb-2"></i>
                <h6 class="mb-1">24/7 Support</h6>
                <small class="text-muted">
                    Dedicated Customer Care
                </small>
            </div>

        </div>
    </div>
</section>