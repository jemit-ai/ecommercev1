<template>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container">
            <Link class="navbar-brand" href="/">
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
                        <Link class="nav-link" href="/">Home</Link>
                    </li>

                    <li class="nav-item mx-3">
                        <Link class="nav-link" href="/products">Products</Link>
                    </li>

                    <li class="nav-item mx-3">
                        <Link class="nav-link" href="/checkout">Checkout</Link>
                    </li>
                </ul>
            </div>

            <div class="header-actions d-none d-lg-flex align-items-center gap-2">
                <Link href="/checkout" class="cart-link" aria-label="Shopping cart">
                    <img :src="cartImage" alt="Cart" class="cart-image" />
                    <span class="cart-text">Cart</span>
                    <span class="cart-badge">{{ cartCount }}</span>
                </Link>

                <div class="user-menu">
                    <details>
                        <summary class="user-trigger">
                            <img :src="profileImage" alt="User avatar" class="avatar-image" />
                            <span class="user-name">{{ authUser ? authUser.name : 'Sign in' }}</span>
                            <ion-icon name="chevron-down-outline"></ion-icon>
                        </summary>
                        <div class="dropdown-menu">
                            <template v-if="authUser">
                                <Link href="/dashboard" class="dropdown-item">Dashboard</Link>
                                <Link href="/profile" class="dropdown-item">Profile</Link>
                                <Link href="/logout" method="post" as="button" class="dropdown-item logout-item">
                                    Logout
                                </Link>
                            </template>
                            <template v-else>
                                <Link href="/login" class="dropdown-item">Login</Link>
                                <Link href="/register" class="dropdown-item">Register</Link>
                            </template>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const authUser = computed(() => page.props.auth?.user || null);
const cartCount = computed(() => page.props.cartCount ?? 0);

const cartImage = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><path fill="%234f46e5" d="M20 20h-4l-2-8H8v4h2.6l4.8 20.2A6 6 0 0 0 21.3 36h22.7a6 6 0 0 0 5.8-4.4L52 24H20v-4Zm6 32a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm20 0a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/></svg>';

const profileImage = computed(() => {
    const name = authUser.value?.name || 'Guest';
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=4f46e5&color=fff&size=128`;
});
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

.header-actions {
    gap: 0.75rem;
}

.cart-link,
.nav-icon,
.nav-action-btn,
.user-trigger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border-radius: 999px;
    text-decoration: none;
    color: #111827;
    background: #f3f4f6;
    padding: 0.6rem 0.9rem;
    font-weight: 600;
    border: 1px solid transparent;
}

.cart-link {
    padding-right: 0.95rem;
}

.cart-image,
.avatar-image {
    width: 1.2rem;
    height: 1.2rem;
    object-fit: cover;
}

.cart-badge {
    min-width: 1.3rem;
    height: 1.3rem;
    padding: 0 0.35rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    font-size: 0.74rem;
    background: #4f46e5;
    color: #fff;
}

.user-menu {
    position: relative;
}

.user-trigger {
    cursor: pointer;
    list-style: none;
    padding: 0.55rem 0.8rem;
    min-width: 8.2rem;
    justify-content: flex-start;
}

.user-name {
    font-size: 0.92rem;
    font-weight: 700;
    color: #111827;
}

.user-trigger::-webkit-details-marker {
    display: none;
}

.avatar-image {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
}

.dropdown-menu {
    position: absolute;
    right: 0;
    top: calc(100% + 0.45rem);
    min-width: 180px;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
    border: 1px solid #e5e7eb;
    padding: 0.4rem;
    z-index: 20;
}

.dropdown-item {
    display: block;
    width: 100%;
    text-align: left;
    background: transparent;
    border: none;
    padding: 0.7rem 0.8rem;
    border-radius: 0.75rem;
    color: #111827;
    text-decoration: none;
    font-weight: 600;
}

.dropdown-item:hover {
    background: #f3f4f6;
    color: #4f46e5;
}

.logout-item {
    color: #dc2626;
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