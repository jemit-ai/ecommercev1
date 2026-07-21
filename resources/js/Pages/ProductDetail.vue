<script setup>
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';


</script>

<template>
    <div class="home-shell">
        <Header />
        <main>
            <section class="product-detail">
                <div class="container">

                    <div class="row g-5 align-items-center">

                        <!-- Product Image -->
                        <div class="col-lg-6">
                            <img src="" alt="Wireless Headphones" class="product-image shadow-sm">
                        </div>

                        <!-- Product Information -->
                        <div class="col-lg-6">

                            <h2 class="fw-bold mb-3">
                                Wireless Bluetooth Headphones
                            </h2>

                            <p class="text-muted">
                                <i class="bi bi-tag"></i>
                                Electronics
                            </p>

                            <div class="mb-3">
                                <span class="product-price">$99.99</span>
                                <span class="old-price">$129.99</span>
                            </div>

                            <p class="mb-4">
                                Experience crystal-clear sound with premium wireless Bluetooth headphones.
                                Featuring noise cancellation, long battery life, soft ear cushions,
                                and fast charging for everyday comfort.
                            </p>

                            <div class="d-flex align-items-center mb-4">

                                <button class="btn btn-primary me-3">
                                    <i class="bi bi-cart"></i>
                                    Add to Cart
                                </button>

                                <button class="btn btn-outline-secondary">
                                    <ion-icon name="heart-outline"></ion-icon>
                                    Wishlist
                                </button>

                            </div>

                            <div class="social-share">
                                <strong class="me-2">Share:</strong>

                                <a href="#">
                                    <ion-icon name="logo-facebook"></ion-icon>
                                </a>

                                <a href="#">
                                    <ion-icon name="logo-twitter"></ion-icon>
                                </a>

                                <a href="#">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </a>

                                <a href="#">
                                    <ion-icon name="logo-linkedin"></ion-icon>
                                </a>

                                <a href="#">
                                    <ion-icon name="logo-whatsapp"></ion-icon>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>
            </section>
        </main>
        <Footer />
    </div>
</template>
