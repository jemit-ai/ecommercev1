<script setup>
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';
import { onMounted, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    approval_url: {
        type: String,
        default: '',
    },
});

onMounted(() => {
    if (props.approval_url) {
        window.location.href = props.approval_url;
    }
});

watch(() => props.approval_url, (newVal) => {
    if (newVal) {
        window.location.href = newVal;
    }
});
</script>

<template>
    <div class="process-page">
        <Header />
        <main class="container text-center py-5">
            <h2>Redirecting to Payment...</h2>
            <p>Please wait while we redirect you to the payment gateway.</p>
        </main>
        <Footer />
    </div>
</template>
