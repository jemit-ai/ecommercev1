<!-- Footer Start -->
<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">

        <div class="row gy-4">

            <!-- Company Info -->
            <div class="col-lg-4 col-md-6">
                <h4 class="fw-bold mb-3">
                    Shop<span class="text-primary">Ease</span>
                </h4>

                <p class="text-muted">
                    Your one-stop destination for premium products at
                    affordable prices. We bring quality, trust, and
                    convenience to your doorstep.
                </p>

                <div class="mt-4">
                    <a href="#" class="text-light me-3">
                        <i class="fa-brands fa-facebook-f fa-lg"></i>
                    </a>

                    <a href="#" class="text-light me-3">
                        <i class="fa-brands fa-instagram fa-lg"></i>
                    </a>

                    <a href="#" class="text-light me-3">
                        <i class="fa-brands fa-x-twitter fa-lg"></i>
                    </a>

                    <a href="#" class="text-light">
                        <i class="fa-brands fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-semibold mb-3">Quick Links</h5>

                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}"
                           class="text-decoration-none text-muted">
                            Home
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href=""
                           class="text-decoration-none text-muted">
                            Shop
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('about') }}"
                           class="text-decoration-none text-muted">
                            About Us
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('contact') }}"
                           class="text-decoration-none text-muted">
                            Contact
                        </a>
                    </li>

                    <li>
                        <a href=""
                           class="text-decoration-none text-muted">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-semibold mb-3">Customer Service</h5>

                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href=""
                           class="text-decoration-none text-muted">
                            Track Order
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#"
                           class="text-decoration-none text-muted">
                            Shipping Policy
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#"
                           class="text-decoration-none text-muted">
                            Return Policy
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#"
                           class="text-decoration-none text-muted">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="text-decoration-none text-muted">
                            Terms & Conditions
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-semibold mb-3">Newsletter</h5>

                <p class="text-muted">
                    Subscribe to receive updates, offers, and new arrivals.
                </p>

                <form action=""
                      method="POST">
                    @csrf

                    <div class="input-group">
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Enter your email"
                               required>

                        <button class="btn btn-primary">
                            Subscribe
                        </button>
                    </div>
                </form>

                <div class="mt-4">
                    <img src="{{ asset('images/payment-methods.png') }}"
                         alt="Payment Methods"
                         class="img-fluid"
                         style="max-width:220px;">
                </div>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <!-- Bottom Footer -->
        <div class="row align-items-center">

            <div class="col-md-6 text-center text-md-start">
                <small class="text-muted">
                    © {{ date('Y') }} ShopEase. All Rights Reserved.
                </small>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <small class="text-muted">
                    Designed with
                    <i class="fa-solid fa-heart text-danger"></i>
                    using Laravel & Bootstrap 5
                </small>
            </div>

        </div>

    </div>
</footer>
<!-- Footer End -->