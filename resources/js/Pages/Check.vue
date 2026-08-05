<script setup>
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';
import OrderSummary from './Components/OrderSummary.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { watch } from 'vue'


const props = defineProps({

    cartItems: {
        type: Array,
        default: () => [],
    },

    shippingCharge: {
        type: Number,
        default: 0,
    },

    totalAmount: {
        type: Number,
        default: 0,
    },

    checkoutToken: {
        type: String,
        default: '',
    },

    /*approval_url: {
        type: String,
        default: '',
    },*/


});

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    address: '',
    country: '',
    state: '',
    zip: '',
    notes: '',
    payment_method: '',
    cartItems: props.cartItems,
    shippingCharge: props.shippingCharge,
    totalAmount: props.totalAmount,
    checkoutToken: props.checkoutToken,
});

const loading = ref(false);

const placeOrder = () => {

    form.cartItems = props.cartItems;
    form.shippingCharge = props.shippingCharge;
    form.totalAmount = props.totalAmount;

    console.log("OrderForm:-" + JSON.stringify(form));

    //console.log("CartItems:-" + JSON.stringify(form.cartItems));
    //console.log("ShippingCharge:-" + form.shippingCharge);
    //console.log("TotalValue:-" + form.totalAmount);

    form.post('/checkout/place-order', {

        preserveScroll: true,
        preserveState: true,

        onStart: () => {
            loading.value = true;
        },

        onFinish: () => {
            loading.value = false;
        },

        onSuccess: () => {
            loading.value = false;

            console.log('Order placed successfully');
        },

        onError: (errors) => {
            loading.value = false;
            console.log(errors);
        },

    });


};


watch(() => props.approval_url, (newVal, oldVal) => {
    console.log('approval_url has changed:', newVal)
})




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

                    <form @submit.prevent="placeOrder">

                        <div class="row g-4">

                            <!-- Left Side: Billing Form -->
                            <div class="col-lg-8">
                                <div class="card checkout-card p-4 shadow-sm">
                                    <h5 class="mb-4">Billing Information</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" id="first_name"
                                                v-model="form.first_name" class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" id="last_name" v-model="form.last_name"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Email Address</label>
                                            <input type="email" name="email" id="email" v-model="form.email"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" id="phone" v-model="form.phone"
                                                class="form-control" />
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label>Street Address</label>
                                            <input type="text" name="address" id="address" v-model="form.address"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Country</label>
                                            <select class="form-select" name="country" id="country"
                                                v-model="form.country">
                                                <option>India</option>
                                                <option>USA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>State</label>
                                            <input type="text" v-model="form.state" class="form-control" name="state"
                                                id="state" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Zip Code</label>
                                            <input type="text" v-model="form.zip" class="form-control" name="zip"
                                                id="zip" />
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label>Order Notes</label>
                                            <textarea v-model="form.notes" class="form-control" name="notes"
                                                id="notes"></textarea>
                                        </div>
                                    </div>
                                    <hr />
                                    <h5 class="mb-3">Payment Method</h5>
                                    <div class="payment-box">
                                        <input type="radio" name="payment_method" id="cod" v-model="form.payment_method"
                                            value="cod" /> Cash On Delivery
                                    </div>

                                    <!--div class="payment-box">
                                        <input type="radio" name="payment_method" id="card"
                                            v-model="form.payment_method" value="card" /> Credit / Debit Card
                                    </div>
                                    <div class="payment-box">
                                        <input type="radio" name="payment_method" id="upi" v-model="form.payment_method"
                                            value="upi" /> UPI
                                    </div>
                                    <div class="payment-box">
                                        <input type="radio" name="payment_method" id="netbnk"
                                            v-model="form.payment_method" value="netbanking" /> Net Banking
                                    </div-->

                                    <div class="payment-box">
                                        <input type="radio" name="payment_method" id="paypal"
                                            v-model="form.payment_method" value="paypal" /> Paypal
                                    </div>


                                    <button type="submit" class="btn btn-primary mt-4" :disabled="form.processing">
                                        {{ form.processing ? 'Placing Order...' : 'Place Order' }}
                                    </button>
                                </div>
                            </div>

                            <!-- Right Side: Order Summary -->
                            <OrderSummary :cartItems="cartItems" :shippingCharge="shippingCharge"
                                :totalAmount="totalAmount" />

                            <input type="hidden" name="shippingCharge" :value="shippingCharge">
                            <input type="hidden" name="totalAmount" :value="totalAmount">

                        </div>

                    </form>

                </div>
            </section>


        </main>
        <Footer />
    </div>
</template>
