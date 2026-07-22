<template>
    <div class="product-card">
        <div class="product-badge">Popular</div>
        <div class="product-content">
            <h3>{{ product.name || 'Premium product' }}</h3>
            <p>{{ product.price ? `${product.price}` : 'From $99' }}</p>
            <button class="btn-cart" type="button" @click="handleClick(product)" :disabled="loading">
                {{ loading ? 'Adding...' : 'Add to Cart' }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const handleClick = (product) => {

    console.log(product);
    // alert('Product clicked' + productID);
    // using inertia 

    try {

        router.post('/cart/add', { product_id: product.id, quantity: 1 }, {

            onStart: () => {
                console.log('Product clicked' + product);
            },
            onFinish: () => {
                console.log('Product clicked' + product);
            },
            onSuccess: () => {
                console.log('Product clicked' + product);
            },
            onError: () => {
                console.log('Product clicked' + product);
            },

        });

    } catch (error) {

        console.error('Unexpected error:', error);
        alert('Something went wrong.');

    }


}

</script>

<style scoped>
.product-card {
    border-radius: 1.25rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06);
    min-height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-badge {
    align-self: flex-start;
    padding: 0.35rem 0.6rem;
    border-radius: 999px;
    background: #eef2ff;
    color: #4f46e5;
    font-size: 0.75rem;
    font-weight: 700;
}

.product-content h3 {
    margin: 0.85rem 0 0.35rem;
    font-size: 1.05rem;
    font-weight: 700;
    color: #111827;
}

.product-content p {
    margin: 0 0 1rem;
    font-weight: 600;
    color: #4f46e5;
}

.btn-cart {
    border: none;
    border-radius: 999px;
    padding: 0.7rem 1rem;
    background: #111827;
    color: #fff;
    font-weight: 600;
}
</style>
