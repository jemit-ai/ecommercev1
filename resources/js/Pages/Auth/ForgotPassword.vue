<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Header from '../Components/Header.vue';
import Footer from '../Components/Footer.vue';

const email = ref('');

const handleSubmit = () => {
    console.log({ email: email.value });
};
</script>

<template>
    <div class="auth-shell">
        <Header />

        <main class="auth-page">
            <div class="auth-card">
                <div class="auth-illustration">
                    <p class="eyebrow">Reset access</p>
                    <h1>Forgot your password?</h1>
                    <p>Enter your email and we’ll send you a secure link to help you set a new password.</p>

                    <ul>
                        <li>Quick recovery for your account</li>
                        <li>Secure reset link delivery</li>
                        <li>Keep your shopping account protected</li>
                    </ul>
                </div>

                <div class="auth-form-panel">
                    <div class="form-top">
                        <div class="brand-badge">ShopGrids</div>
                        <p class="helper-text"><Link href="/login">Back to login</Link></p>
                    </div>

                    <h2>Reset password</h2>
                    <p class="form-intro">We’ll send a recovery email to the address below.</p>

                    <form class="auth-form" @submit.prevent="handleSubmit">
                        <label>
                            <span>Email address</span>
                            <input v-model="email" type="email" placeholder="you@example.com" required />
                        </label>

                        <button type="submit" class="submit-btn">Send reset link</button>
                    </form>
                </div>
            </div>
        </main>

        <Footer />
    </div>
</template>

<style scoped>
.auth-shell {
    background: linear-gradient(180deg, #fdfdfd 0%, #f7f8fc 100%);
}

.auth-page {
    padding: 3rem 0 4rem;
}

.auth-card {
    width: min(1100px, calc(100% - 2rem));
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.05fr 0.95fr;
    border-radius: 1.8rem;
    overflow: hidden;
    box-shadow: 0 24px 55px rgba(15, 23, 42, 0.1);
    background: #fff;
}

.auth-illustration {
    padding: 2.4rem;
    background: linear-gradient(135deg, #111827 0%, #4338ca 100%);
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.eyebrow {
    margin: 0 0 0.4rem;
    color: #c7d2fe;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.auth-illustration h1 {
    margin: 0 0 0.7rem;
    font-size: clamp(1.5rem, 3vw, 2rem);
}

.auth-illustration p {
    margin: 0 0 1rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.7;
}

.auth-illustration ul {
    margin: 0;
    padding-left: 1.15rem;
    color: rgba(255, 255, 255, 0.9);
    display: grid;
    gap: 0.45rem;
}

.auth-form-panel {
    padding: 2.2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.form-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.brand-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.45rem 0.8rem;
    border-radius: 999px;
    background: #eef2ff;
    color: #4338ca;
    font-weight: 700;
}

.helper-text,
.form-intro {
    margin: 0;
    color: #64748b;
    font-size: 0.95rem;
}

.helper-text a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 600;
}

.auth-form-panel h2 {
    margin: 1rem 0 0.25rem;
    color: #111827;
    font-size: 1.5rem;
}

.auth-form {
    display: grid;
    gap: 1rem;
    margin-top: 1rem;
}

.auth-form label {
    display: grid;
    gap: 0.4rem;
    font-weight: 600;
    color: #111827;
}

.auth-form input {
    border: 1px solid #d1d5db;
    border-radius: 0.9rem;
    padding: 0.85rem 1rem;
    font-size: 0.95rem;
    outline: none;
    transition: border-color 180ms ease, box-shadow 180ms ease;
}

.auth-form input:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
}

.submit-btn {
    border: none;
    border-radius: 999px;
    padding: 0.9rem 1rem;
    background: linear-gradient(135deg, #4f46e5 0%, #111827 100%);
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    transition: transform 180ms ease;
}

.submit-btn:hover {
    transform: translateY(-1px);
}

@media (max-width: 900px) {
    .auth-card {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .auth-illustration,
    .auth-form-panel {
        padding: 1.25rem;
    }
}
</style>
