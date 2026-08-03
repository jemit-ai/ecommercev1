<script setup>
import Header from '../Components/Header.vue';
import Footer from '../Components/Footer.vue';
</script>

<template>
    <div class="home-shell">
        <Header />
        <main class="container py-5 text-center">
            <h2 class="display-4 fw-bold text-danger">Payment Cancelled</h2>
            <p class="lead">
                Your payment was not completed. You can try again or continue browsing.
            </p>
            <div class="mt-4">
                <a href="/checkout" class="btn btn-primary me-2">Return to Checkout</a>
                <a href="/" class="btn btn-outline-secondary">Continue Shopping</a>
            </div>
        </main>
        <Footer />
    </div>
</template>

<style scoped>
.home-shell {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1;
}
</style>
