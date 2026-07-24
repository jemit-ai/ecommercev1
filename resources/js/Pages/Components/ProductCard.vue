<template>
    <div class="product-card">
        <div class="product-media">
            <span class="product-badge">Popular</span>
            <div class="product-illustration" aria-hidden="true">✨</div>
        </div>

        <div class="product-content">
            <div class="product-info">
                <h3>{{ product.name || 'Premium product' }}</h3>
                <p class="product-price">{{ product.price ? `$${Number(product.price).toFixed(2)}` : 'From $99' }}</p>
            </div>

            <div class="product-actions">
                <span class="product-status">In stock</span>
                <button class="btn-cart" type="button" @click="handleClick(product)" :disabled="loading">
                    {{ loading ? 'Adding...' : 'Add to Cart' }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const loading = ref(false);

const handleClick = (product) => {

    if (!product?.id) {
        return;
    }

    loading.value = true;

    try {

        router.post('/cart/add', { product_id: product.id, quantity: 1 }, {
            preserveScroll: false,
            onStart: () => {
                loading.value = true;
            },
            onFinish: () => {
                loading.value = false;
            },
            onSuccess: () => {
                loading.value = false;
            },
            onError: () => {
                loading.value = false;
            },
        });

    } catch (error) {
        loading.value = false;
        console.error('Unexpected error:', error);
        //alert('Something went wrong.');
    }
};
</script>

<style scoped>
.product-card {
    border-radius: 1.4rem;
    padding: 1.1rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    min-height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 180ms ease, box-shadow 180ms ease;
    border: 1px solid rgba(148, 163, 184, 0.16);
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 24px 50px rgba(15, 23, 42, 0.12);
}

.product-media {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 0.85rem;
}

.product-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.35rem 0.7rem;
    border-radius: 999px;
    background: #eef2ff;
    color: #4338ca;
    font-size: 0.74rem;
    font-weight: 700;
}

.product-illustration {
    width: 3rem;
    height: 3rem;
    border-radius: 1rem;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    font-size: 1.2rem;
}

.product-content {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
}

.product-info h3 {
    margin: 0 0 0.35rem;
    font-size: 1.05rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
}

.product-price {
    margin: 0;
    font-weight: 700;
    color: #4f46e5;
    font-size: 1rem;
}

.product-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
}

.product-status {
    font-size: 0.8rem;
    font-weight: 600;
    color: #059669;
}

.btn-cart {
    border: none;
    border-radius: 999px;
    padding: 0.7rem 1rem;
    background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    transition: transform 180ms ease, opacity 180ms ease;
}

.btn-cart:hover:not(:disabled) {
    transform: translateY(-1px);
}

.btn-cart:disabled {
    opacity: 0.75;
    cursor: wait;
}
</style>
