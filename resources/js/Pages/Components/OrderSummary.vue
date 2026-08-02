<template>

    <div class="col-lg-4">
        <div class="card checkout-card p-4 shadow-sm">

            <h5 class="mb-4">Order Summary</h5>


            <OrderItem :cartItems="props.cartItems" :shippingCharge="props.shippingCharge"
                @update:subTotal="subTotal = $event" />

            <hr />
            <div class="input-group mb-4">
                <input class="form-control" placeholder="Coupon Code" />
                <button class="btn btn-dark">Apply</button>
            </div>

            <div class="summary-row"><span>Subtotal</span><strong> $ {{ subTotal }}</strong></div>
            <div class="summary-row"><span>Shipping</span><strong> $ {{ shippingCharge }}</strong></div>
            <!--div class="summary-row"><span>Discount</span><strong class="text-success"> ₹ 200</strong></div>
                <div class="summary-row"><span>Tax</span><strong> ₹ 450</strong></div-->

            <hr />
            <div class="summary-row fs-5"><strong>Total</strong><strong class="text-primary"> $ {{ totalAmount
                    }}</strong></div>
            <button class="btn btn-primary w-100 btn-place-order mt-3">
                <i class="bi bi-lock-fill"></i> Place Order
            </button>

            <div class="text-center mt-3 text-muted">
                <small><i class="bi bi-shield-check"></i> Secure Checkout</small>
            </div>


        </div>
    </div>

</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ref } from 'vue';
import OrderItem from './Order/OrderItem.vue';

const subTotal = ref(0)

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

//console.log("Says from parent" + props.cartItems);

</script>