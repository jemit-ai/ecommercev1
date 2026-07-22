<template>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container">

            <Link class="navbar-brand">
                <img src="./images/logo/logo.png" alt="ShopGrids" width="150" />
            </Link>

            <div class="d-flex align-items-center gap-2">
                <div class="search-box d-none d-lg-flex">
                    <ion-icon name="search-outline"></ion-icon>
                    <input type="text" placeholder="Search products" />
                </div>
                <div class="d-block d-lg-none nav-icon" id="fer-bar">
                    <ion-icon name="person-outline"></ion-icon>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span><ion-icon name="menu"></ion-icon></span>
                </button>
            </div>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mx-3">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="/products">Products</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="/checkout">Checkout</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#footer">Contacts</a>
                    </li>
                </ul>
            </div>

            <div class="d-none d-lg-flex align-items-center gap-2">
                <!--a href="#" class="nav-icon icon-pill" aria-label="Wishlist">
                    <ion-icon name="heart-outline"></ion-icon>
                </a>
                <a href="#" class="nav-icon icon-pill" aria-label="Cart">
                    <ion-icon name="bag-outline"></ion-icon>
                </a-->

                <!--a :href="route('cart.index')" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                    <ion-icon name="cart-outline" style="font-size:24px;"></ion-icon>
                    <span>Cart</span>
                </a-->

                <!--a href="#" class="nav-action-btn">Login</a>
                <a href="#" class="nav-action-btn primary">Register</a-->

            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { route } from 'ziggy-js'

const page = usePage()

//console.log("Header Props:", JSON.stringify(page.props));

const cartCount = computed(() => page.props.cartCount ?? 0)

//console.log("Count: " + cartCount.value);

</script>


<style scoped>
#nav {
    padding: 1rem 0;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
}

.navbar-brand img {
    max-height: 42px;
    object-fit: contain;
}

.nav-link {
    color: #374151;
    font-weight: 600;
}

.nav-link.active,
.nav-link:hover {
    color: #4f46e5;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 0.9rem;
    border-radius: 999px;
    background: #f3f4f6;
    min-width: 240px;
}

.search-box input {
    border: none;
    outline: none;
    background: transparent;
    width: 100%;
    color: #111827;
}

.nav-icon,
.nav-action-btn {
    width: 2.4rem;
    height: 2.4rem;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f3f4f6;
    color: #111827;
    text-decoration: none;
}

.nav-action-btn {
    width: auto;
    padding: 0 0.95rem;
    border-radius: 999px;
    font-size: 0.95rem;
    font-weight: 600;
}

.nav-action-btn.primary {
    background: #4f46e5;
    color: #fff;
}

.icon-pill {
    border: 1px solid #e5e7eb;
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.05);
}
</style>