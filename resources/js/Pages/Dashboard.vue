<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';
import ProductCard from './Components/ProductCard.vue';

const page = usePage();
const user = computed(() => page.props.auth?.user || { name: 'there' });

const stats = [
    { label: 'Orders', value: '12', detail: '2 pending' },
    { label: 'Wishlist', value: '7', detail: 'Fresh picks' },
    { label: 'Rewards', value: '480', detail: 'Points earned' },
    { label: 'Support', value: '24/7', detail: 'Always online' },
];

const recentOrders = [
    { id: '#1024', item: 'Wireless Headphones', status: 'Delivered', date: 'Today' },
    { id: '#1018', item: 'Smart Lamp', status: 'Processing', date: 'Yesterday' },
    { id: '#1007', item: 'Travel Backpack', status: 'Shipped', date: '2 days ago' },
];

const featuredProducts = [
    { id: 1, name: 'Aurora Headphones', price: 149.99 },
    { id: 2, name: 'Luna Smart Lamp', price: 89.5 },
    { id: 3, name: 'Nova Backpack', price: 74.0 },
];
</script>

<template>
    <div class="dashboard-shell">
        <Header />

        <main>
            <section class="dashboard-hero">
                <div class="container hero-card">
                    <div class="hero-copy">
                        <p class="eyebrow">Welcome back</p>
                        <h1>Hello, {{ user.name }} 👋</h1>
                        <p>
                            Stay on top of your orders, discover fresh picks, and keep your cart ready for checkout.
                        </p>

                        <div class="hero-actions">
                            <Link href="/products" class="btn-primary">Browse products</Link>
                            <Link href="/cart" class="btn-secondary">View cart</Link>
                        </div>
                    </div>

                    <div class="hero-panel">
                        <div class="panel-pill">Free shipping over $75</div>
                        <div class="panel-highlight">
                            <h3>Next delivery</h3>
                            <p>Estimated arrival in 2 days</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="dashboard-content">
                <div class="container">
                    <div class="stats-grid">
                        <div v-for="item in stats" :key="item.label" class="stat-card">
                            <p class="stat-label">{{ item.label }}</p>
                            <h3>{{ item.value }}</h3>
                            <span>{{ item.detail }}</span>
                        </div>
                    </div>

                    <div class="content-grid">
                        <div class="panel-card">
                            <div class="panel-heading">
                                <div>
                                    <p class="eyebrow">Activity</p>
                                    <h2>Recent orders</h2>
                                </div>
                                <Link href="/orders" class="text-link">View all</Link>
                            </div>

                            <ul class="order-list">
                                <li v-for="order in recentOrders" :key="order.id" class="order-item">
                                    <div>
                                        <strong>{{ order.item }}</strong>
                                        <p>{{ order.id }} • {{ order.date }}</p>
                                    </div>
                                    <span :class="['status-pill', order.status.toLowerCase()]">{{ order.status }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="panel-card">
                            <div class="panel-heading">
                                <div>
                                    <p class="eyebrow">For you</p>
                                    <h2>Recommended</h2>
                                </div>
                                <Link href="/products" class="text-link">See more</Link>
                            </div>

                            <div class="recommended-grid">
                                <ProductCard
                                    v-for="product in featuredProducts"
                                    :key="product.id"
                                    :product="product"
                                    class="recommended-card"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <Footer />
    </div>
</template>

<style scoped>
.dashboard-shell {
    background: linear-gradient(180deg, #fdfdfd 0%, #f7f8fc 100%);
}

.container {
    width: min(1120px, calc(100% - 2rem));
    margin: 0 auto;
}

.dashboard-hero {
    padding: 2.5rem 0 1.25rem;
}

.hero-card {
    display: grid;
    grid-template-columns: 1.4fr 0.8fr;
    gap: 1.25rem;
    padding: 2rem;
    border-radius: 1.8rem;
    background: linear-gradient(135deg, #111827 0%, #4338ca 100%);
    color: #fff;
    box-shadow: 0 24px 50px rgba(17, 24, 39, 0.15);
}

.hero-copy h1 {
    margin: 0 0 0.7rem;
    font-size: clamp(1.7rem, 3vw, 2.5rem);
}

.hero-copy p {
    margin: 0;
    color: rgba(255, 255, 255, 0.86);
    line-height: 1.7;
}

.eyebrow {
    margin: 0 0 0.35rem;
    color: #c7d2fe;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1.25rem;
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    padding: 0.8rem 1rem;
    font-weight: 700;
    text-decoration: none;
    transition: transform 180ms ease, opacity 180ms ease;
}

.btn-primary {
    background: #fff;
    color: #111827;
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.14);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-primary:hover,
.btn-secondary:hover {
    transform: translateY(-1px);
}

.hero-panel {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
}

.panel-pill,
.panel-highlight {
    border-radius: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.14);
    border: 1px solid rgba(255, 255, 255, 0.16);
}

.panel-pill {
    font-weight: 700;
}

.panel-highlight h3 {
    margin: 0 0 0.25rem;
    font-size: 1rem;
}

.panel-highlight p {
    margin: 0;
    color: rgba(255, 255, 255, 0.78);
}

.dashboard-content {
    padding: 1rem 0 4rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.stat-card {
    padding: 1rem 1.1rem;
    border-radius: 1.2rem;
    background: #fff;
    box-shadow: 0 16px 36px rgba(15, 23, 42, 0.06);
    border: 1px solid rgba(148, 163, 184, 0.16);
}

.stat-label {
    margin: 0 0 0.4rem;
    color: #64748b;
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.stat-card h3 {
    margin: 0 0 0.25rem;
    font-size: 1.3rem;
    color: #111827;
}

.stat-card span {
    color: #4f46e5;
    font-size: 0.9rem;
    font-weight: 600;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 1rem;
}

.panel-card {
    padding: 1.2rem;
    border-radius: 1.4rem;
    background: #fff;
    box-shadow: 0 16px 36px rgba(15, 23, 42, 0.06);
    border: 1px solid rgba(148, 163, 184, 0.16);
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.panel-heading h2 {
    margin: 0;
    font-size: 1.2rem;
    color: #111827;
}

.text-link {
    color: #4f46e5;
    font-weight: 700;
    text-decoration: none;
}

.order-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: 0.8rem;
}

.order-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    padding: 0.85rem 0;
    border-bottom: 1px solid #e5e7eb;
}

.order-item:last-child {
    border-bottom: 0;
    padding-bottom: 0;
}

.order-item strong {
    display: block;
    color: #111827;
}

.order-item p {
    margin: 0.2rem 0 0;
    font-size: 0.88rem;
    color: #64748b;
}

.status-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.4rem 0.65rem;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 700;
    white-space: nowrap;
}

.status-pill.delivered {
    background: #dcfce7;
    color: #166534;
}

.status-pill.processing {
    background: #fef3c7;
    color: #92400e;
}

.status-pill.shipped {
    background: #dbeafe;
    color: #1d4ed8;
}

.recommended-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.85rem;
}

.recommended-card {
    min-height: auto;
}

@media (max-width: 900px) {
    .hero-card,
    .content-grid {
        grid-template-columns: 1fr;
    }

    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 640px) {
    .stats-grid,
    .recommended-grid {
        grid-template-columns: 1fr;
    }

    .hero-card {
        padding: 1.25rem;
    }
}
</style>