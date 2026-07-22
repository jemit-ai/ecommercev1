<script setup>
const products = [
    { id: 1, name: 'Cloudline Coat', price: '$129', image: './images/products/Sellers_1.png' },
    { id: 2, name: 'Monarch Jacket', price: '$149', image: './images/products/Sellers_2.png' },
    { id: 3, name: 'Harbor Knit', price: '$98', image: './images/products/Sellers_3.png' },
    { id: 4, name: 'Lumen Hoodie', price: '$89', image: './images/products/Sellers_4.png' },
];
</script>

<template>
    <section class="sellers" id="sellers">
        <div class="container py-5">
            <div class="section-header">
                <div>
                    <p class="eyebrow">Trending now</p>
                    <h2>New sellers</h2>
                </div>
                <a href="#latest" class="view-link">See collection</a>
            </div>

            <div class="row g-4">
                <div v-for="product in products" :key="product.id" class="col-12 col-sm-6 col-lg-3">
                    <div class="product-card">
                        <div class="card-top">
                            <span class="tag">Hot</span>
                            <button class="icon-btn" type="button" aria-label="Save product">
                                <ion-icon name="heart-outline"></ion-icon>
                            </button>
                        </div>
                        <img :src="product.image" :alt="product.name" />
                        <div class="card-body">
                            <div>
                                <h3>{{ product.name }}</h3>
                                <p>{{ product.price }}</p>
                            </div>
                            <button class="bag-btn" type="button" aria-label="Add to bag">
                                <ion-icon name="bag-add-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.sellers {
    padding: 1rem 0 3rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-header h2 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
    color: #111827;
}

.eyebrow {
    margin: 0 0 0.25rem;
    color: #6366f1;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.view-link {
    color: #4f46e5;
    font-weight: 600;
    text-decoration: none;
}

.product-card {
    border-radius: 1.25rem;
    padding: 1rem;
    background: #fff;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 24px 48px rgba(15, 23, 42, 0.12);
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.tag {
    padding: 0.3rem 0.6rem;
    border-radius: 999px;
    font-size: 0.75rem;
    background: #eef2ff;
    color: #4f46e5;
    font-weight: 700;
}

.icon-btn,
.bag-btn {
    border: none;
    width: 2.3rem;
    height: 2.3rem;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f3f4f6;
    color: #374151;
}

.product-card img {
    width: 100%;
    border-radius: 1rem;
    margin-bottom: 1rem;
    object-fit: cover;
    min-height: 220px;
    background: #f9fafb;
}

.card-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.75rem;
}

.card-body h3 {
    margin: 0 0 0.3rem;
    font-size: 1rem;
    color: #111827;
}

.card-body p {
    margin: 0;
    color: #4f46e5;
    font-weight: 700;
}
</style>