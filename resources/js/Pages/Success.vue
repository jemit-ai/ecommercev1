<script setup>
import Header from '../Components/Header.vue';
import Footer from '../Components/Footer.vue';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
</script>

<template>
  <div class="home-shell">
    <Header />
    <main class="container py-5 text-center">
      <h2 class="display-4 fw-bold">Payment Successful!</h2>
      <p class="lead">Thank you for your purchase. Your order has been placed and will be processed shortly.</p>
      <div class="mt-4">
        <a href="/" class="btn btn-primary me-2">Continue Shopping</a>
        <a href="/orders" class="btn btn-outline-secondary">View Orders</a>
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
