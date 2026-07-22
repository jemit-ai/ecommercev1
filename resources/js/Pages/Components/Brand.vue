<template>
    <section class="brands">
        <div class="container">
            <div class="brand-strip">
                <div class="brand-pill"><img src="./images/brands/gucci.png" alt="Gucci" /></div>
                <div class="brand-pill"><img src="./images/brands/H&M.png" alt="H&M" /></div>
                <div class="brand-pill"><img src="./images/brands/nike.png" alt="Nike" /></div>
                <div class="brand-pill"><img src="./images/brands/the.png" alt="The Row" /></div>
                <div class="brand-pill"><img src="./images/brands/prada.png" alt="Prada" /></div>
                <div class="brand-pill"><img src="./images/brands/ellesse.png" alt="Ellesse" /></div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.brands {
    padding: 1rem 0 2rem;
}

.brand-strip {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 1rem;
    align-items: center;
}

.brand-pill {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 78px;
    border-radius: 1rem;
    background: rgba(255, 255, 255, 0.85);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
    padding: 0.9rem;
}

.brand-pill img {
    width: 100%;
    max-width: 70px;
    object-fit: contain;
    filter: grayscale(0.2);
}

@media (max-width: 768px) {
    .brand-strip {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}
</style>