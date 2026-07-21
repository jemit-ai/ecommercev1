<script setup>
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';

</script>



<template>
    <div class="home-shell">
        <Header />
        <main>

            <h3 class="mb-4">
                Checkout
            </h3>

            <div class="row g-4">

                <!-- Left Side -->

                <div class="col-lg-8">

                    <div class="card checkout-card p-4">

                        <h5 class="mb-4">
                            Billing Information
                        </h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>First Name</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email Address</label>
                                <input type="email" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-12 mb-3">
                                <label>Street Address</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Country</label>
                                <select class="form-select">
                                    <option>India</option>
                                    <option>USA</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>State</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Zip Code</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-12 mb-3">
                                <label>Order Notes</label>
                                <textarea class="form-control"></textarea>
                            </div>

                        </div>

                        <hr>

                        <h5 class="mb-3">
                            Payment Method
                        </h5>

                        <div class="payment-box">
                            <input type="radio" checked>
                            Cash On Delivery
                        </div>

                        <div class="payment-box">
                            <input type="radio">
                            Credit / Debit Card
                        </div>

                        <div class="payment-box">
                            <input type="radio">
                            UPI
                        </div>

                        <div class="payment-box">
                            <input type="radio">
                            Net Banking
                        </div>

                    </div>

                </div>

                <!-- Right Side -->

                <div class="col-lg-4">

                    <div class="card checkout-card p-4">

                        <h5 class="mb-4">
                            Order Summary
                        </h5>

                        <div class="product-item d-flex align-items-center mb-3">

                            <img src="https://picsum.photos/100?1">

                            <div class="ms-3 flex-grow-1">
                                <strong>Wireless Headphones</strong>
                                <br>
                                <small>Qty : 1</small>
                            </div>

                            <div class="price">
                                ₹1,999
                            </div>

                        </div>

                        <div class="product-item d-flex align-items-center mb-3">

                            <img src="https://picsum.photos/100?2">

                            <div class="ms-3 flex-grow-1">
                                <strong>Smart Watch</strong>
                                <br>
                                <small>Qty : 2</small>
                            </div>

                            <div class="price">
                                ₹6,998
                            </div>

                        </div>

                        <hr>

                        <div class="input-group mb-4">

                            <input class="form-control" placeholder="Coupon Code">

                            <button class="btn btn-dark">
                                Apply
                            </button>

                        </div>

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <strong>₹8,997</strong>
                        </div>

                        <div class="summary-row">
                            <span>Shipping</span>
                            <strong>₹150</strong>
                        </div>

                        <div class="summary-row">
                            <span>Discount</span>
                            <strong class="text-success">-₹200</strong>
                        </div>

                        <div class="summary-row">
                            <span>Tax</span>
                            <strong>₹450</strong>
                        </div>

                        <hr>

                        <div class="summary-row fs-5">
                            <strong>Total</strong>
                            <strong class="text-primary">
                                ₹9,397
                            </strong>
                        </div>

                        <button class="btn btn-primary w-100 btn-place-order mt-3">
                            <i class="bi bi-lock-fill"></i>
                            Place Order
                        </button>

                        <div class="text-center mt-3 text-muted">
                            <small>
                                <i class="bi bi-shield-check"></i>
                                Secure Checkout
                            </small>
                        </div>

                    </div>

                </div>

            </div>

        </main>
        <Footer />
    </div>
</template>
