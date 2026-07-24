<script setup>
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';
import OrderSummary from './Components/OrderSummary.vue';


const props = defineProps({

    cartItems: {
        cartItems: Array,
    },
    shippingCharge: {
        type: Number,
        default: 0,
    },
    totalAmount: {
        type: Number,
        default: 0,
    },

});

//console.log("Saying from check page:- " + JSON.stringify(props.cartItems));

</script>



<template>
    <div class="home-shell">
        <Header />
        <main>
            <!-- Hero Section -->
            <section class="checkout-hero py-5 bg-light">
                <div class="container text-center">
                    <h2 class="display-5 fw-bold">Secure Checkout</h2>
                    <p class="text-muted">Complete your purchase in just a few steps.</p>
                </div>
            </section>

            <!-- Main Checkout Content -->
            <section class="checkout-content py-5">
                <div class="container">
                    <div class="row g-4">
                        <!-- Left Side: Billing Form -->
                        <div class="col-lg-8">
                            <div class="card checkout-card p-4 shadow-sm">
                                <h5 class="mb-4">Billing Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label>Street Address</label>
                                        <input type="text" class="form-control" />
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
                                        <input type="text" class="form-control" />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Zip Code</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label>Order Notes</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                                <hr />
                                <h5 class="mb-3">Payment Method</h5>
                                <div class="payment-box">
                                    <input type="radio" checked /> Cash On Delivery
                                </div>
                                <div class="payment-box">
                                    <input type="radio" /> Credit / Debit Card
                                </div>
                                <div class="payment-box">
                                    <input type="radio" /> UPI
                                </div>
                                <div class="payment-box">
                                    <input type="radio" /> Net Banking
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Order Summary -->
                        <OrderSummary :cartItems="cartItems" :shippingCharge="shippingCharge"
                            :totalAmount="totalAmount" />

                    </div>
                </div>
            </section>
        </main>
        <Footer />
    </div>
</template>
