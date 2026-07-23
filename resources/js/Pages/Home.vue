<script setup>
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';
import Hero from './Components/Hero.vue';
import Brand from './Components/Brand.vue';
import Seller from './Components/Seller.vue';
import ProductCard from './Components/ProductCard.vue';

defineProps({
    latestProducts: Array,
});
</script>

<template>
    <div class="home-shell">
        <Header />
        <main>
            <Hero />
            <Brand />
            <Seller />
            <section class="latest-section" id="latest">
                <div class="container">
                    <div class="section-heading">

                        <div>
                            <p class="eyebrow">Fresh arrivals</p>
                            <h2>Latest Products</h2>
                        </div>

                        <!--a href="/" class="view-all">View All</a-->

                        <link href="/products" class="view-all">View All</link>

                    </div>
                    <div class="row g-4">
                        <ProductCard v-for="product in latestProducts" :key="product.id" :product="product"
                            class="col-12 col-sm-6 col-md-4 col-lg-3" />
                    </div>
                </div>
            </section>
        </main>
        <Footer />
    </div>
</template>

<style scoped>
.home-shell {
    background: linear-gradient(180deg, #fdfdfd 0%, #f7f8fc 100%);
}

.latest-section {
    padding: 4rem 0 5rem;
}

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.75rem;
}

.eyebrow {
    margin: 0 0 0.25rem;
    color: #6366f1;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.section-heading h2 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
    color: #111827;
}

.view-all {
    color: #4f46e5;
    font-weight: 600;
    text-decoration: none;
    padding: 0.6rem 1rem;
    border: 1px solid rgba(79, 70, 229, 0.2);
    border-radius: 999px;
    transition: all 0.2s ease;
}

.view-all:hover {
    background: #4f46e5;
    color: #fff;
}
</style>