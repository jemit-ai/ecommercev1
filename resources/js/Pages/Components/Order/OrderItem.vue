<template>

    <div class="product-item d-flex align-items-center mb-3" v-for="item in props.cartItems" :key="item.id">

        <img src="https://picsum.photos/100?1" />

        <div class="ms-3 flex-grow-1">
            <strong>{{ item.product.name }}</strong><br />
            <!--small>Qty : {{ item.quantity }}</small-->

            <button class="btn btn-sm btn-outline-secondary" @click="changeQty(item, 'decr')">
                <i class="bi bi-dash"></i>
            </button>

            <span class="mx-3 fw-bold">{{ item.quantity }}</span>

            <button class="btn btn-sm btn-outline-secondary" @click="changeQty(item, 'incr')">
                <i class="bi bi-plus"></i>
            </button>

        </div>

        <div class="price"><b>${{ item.subtotal }}</b></div>

        <i class="bi bi-x text-danger" style="cursor:pointer; font-size:24px; font-weight:900;"
            @click="removeItem(item)"></i>


    </div>

</template>

<script setup>
import { computed, watch } from 'vue';
import { router } from '@inertiajs/vue3';

//import { route } from '@inertiajs/vue3';

const emit = defineEmits(['update:subTotal']);

const props = defineProps({

    cartItems: {
        type: Array,
        default: () => []
    }


});

const subTotal = computed(() =>

    props.cartItems?.reduce((sum, item) =>
        sum + Number(item.subtotal), 0).toFixed(2) ?? "0.00"

);

watch(
    subTotal,
    (value) => {
        emit('update:subTotal', value);
    },
    { immediate: true }
);



const removeItem = (item) => {

    try {

        router.post('/cart/remove', { product_id: item.product.id, quantity: item.quantity }, {
            preserveScroll: false,
            onStart: () => {
                console.log('Product clicked' + item);
            },
            onFinish: () => {
                console.log('Product clicked' + item);
            },
            onSuccess: () => {
                console.log('Product clicked' + item);
            },
            onError: () => {
                console.log('Product clicked' + item);
            },

        });

    } catch (error) {

        console.log(error);

    }

}


const changeQty = (item, type) => {

    try {

        let quantity = (type == 'incr') ? 1 : -1;

        router.post('/cart/update', { product_id: item.product.id, quantity: quantity, type: type }, {
            preserveScroll: false,
            onStart: () => {
                console.log('Product clicked' + item);
            },
            onFinish: () => {
                console.log('Product clicked' + item);
            },
            onSuccess: () => {
                console.log('Product clicked' + item);
            },
            onError: () => {
                console.log('Product clicked' + item);
            },

        });

    } catch (error) {

        console.log(error);

    }
}

</script>