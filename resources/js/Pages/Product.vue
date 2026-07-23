<script setup>
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';
import ProductCard from './Components/ProductCard.vue';
import PriceSlider from './Components/PriceSlider.vue';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue'


const categories = ['Electronics', 'Fashion', 'Shoes', 'Furniture', 'Sports'];
const brands = ['Apple', 'Samsung', 'Sony', 'Nike', 'Adidas'];

const props = defineProps({
    products: Array,
    minPrice: Number,
    maxPrice: Number,
});

const selectedPrice = ref(props.minPrice);

const form = useForm({
    name: '',
    category: '',
    brand: '',
    price: '',
});

const applyFilters = () => {

    console.log(form.price);

    // Update price field with selectedPrice
    form.price = selectedPrice.value;

    //console.log("Form:-" + form.name);

    form.get('/products', {
        preserveState: true,
        preserveScroll: true
    });

}

</script>

<template>
    <div class="product-page">
        <Header />
        <main>
            <section class="page-hero">
                <div class="container">
                    <div class="hero-content">
                        <p class="eyebrow">Curated collection</p>
                        <h1>Discover premium products</h1>
                        <p>Browse hand-picked essentials with modern design, fast delivery, and everyday comfort.</p>
                        <div class="hero-badges">
                            <span>Free shipping over $80</span>
                            <span>New arrivals weekly</span>
                            <span>Secure checkout</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="catalog-section">
                <div class="container">
                    <div class="row g-4">

                        <aside class="col-lg-3">
                            <form @submit.prevent="applyFilters" method="GET">
                                <div class="filter-card">

                                    <div class="filter-header">
                                        <h3>Filters</h3>
                                        <button type="button" class="ghost-btn">Reset</button>
                                    </div>

                                    <div class="filter-group">
                                        <label class="filter-label" for="search">Search</label>
                                        <input id="search" type="text" class="form-control"
                                            placeholder="Search products" v-model="form.name">
                                    </div>

                                    <div class="filter-group">
                                        <h4>Categories</h4>
                                        <ul class="category-list">
                                            <li v-for="category in categories" :key="category">
                                                <a href="#">{{ category }}</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <PriceSlider :minPrice="props.minPrice" :maxPrice="props.maxPrice"
                                        v-model="selectedPrice" />

                                    <div class="filter-group">
                                        <h4>Brands</h4>
                                        <div v-for="brand in brands" :key="brand" class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">{{ brand }}</label>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary w-100 mt-3" @click="applyFilters">Apply
                                        Filters</button>
                                </div>
                            </form>
                        </aside>

                        <div class="col-lg-9">
                            <div class="toolbar">
                                <div>
                                    <p class="eyebrow">Collection</p>
                                    <h2>Latest Products</h2>
                                </div>
                                <select class="form-select sort-select">
                                    <option>Newest</option>
                                    <option>Price Low to High</option>
                                    <option>Price High to Low</option>
                                    <option>Popularity</option>
                                </select>
                            </div>

                            <div class="row g-4">
                                <ProductCard v-for="product in props.products" :key="product.id" :product="product"
                                    class="col-md-6 col-xl-4" />
                            </div>

                            <nav class="pagination-wrap">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </section>
        </main>
        <Footer />
    </div>
</template>

<style scoped>
.product-page {
    background: linear-gradient(180deg, #fdfdfd 0%, #f7f8fc 100%);
}

.page-hero {
    padding: 3.2rem 0 2rem;
}

.hero-content {
    padding: 2rem;
    border-radius: 1.5rem;
    background: radial-gradient(circle at top left, rgba(79, 70, 229, 0.18), transparent 35%), #fff;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
}

.eyebrow {
    margin: 0 0 0.35rem;
    color: #6366f1;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.hero-content h1 {
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 800;
    color: #111827;
    margin-bottom: 0.7rem;
}

.hero-content p {
    color: #6b7280;
    margin-bottom: 0.9rem;
}

.hero-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 0.7rem;
}

.hero-badges span {
    padding: 0.5rem 0.8rem;
    border-radius: 999px;
    background: #f3f4f6;
    color: #374151;
    font-size: 0.9rem;
}

.catalog-section {
    padding: 0 0 4rem;
}

.filter-card,
.toolbar {
    background: #fff;
    border-radius: 1.25rem;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
}

.filter-card {
    padding: 1.25rem;
}

.filter-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.filter-header h3,
.toolbar h2,
.filter-group h4 {
    margin: 0;
    color: #111827;
}

.ghost-btn {
    border: none;
    background: transparent;
    color: #4f46e5;
    font-weight: 600;
}

.filter-group {
    margin-bottom: 1rem;
}

.filter-label {
    display: block;
    margin-bottom: 0.4rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #374151;
}

.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li+li {
    margin-top: 0.45rem;
}

.category-list a {
    color: #4b5563;
    text-decoration: none;
}

.category-list a:hover {
    color: #4f46e5;
}

.price-range {
    margin-top: 0.45rem;
    color: #6b7280;
}

.toolbar {
    padding: 1.1rem 1.25rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.25rem;
}

.sort-select {
    max-width: 220px;
}

.pagination-wrap {
    margin-top: 2rem;
}
</style>