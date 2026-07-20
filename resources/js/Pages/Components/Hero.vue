<template>
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-12 col-lg-6">
                    <div class="hero-copy">
                        <p class="hero-eyebrow">Autumn / Winter 2026</p>
                        <h1>Elevated essentials for every season.</h1>
                        <p class="hero-text">
                            Discover modern layers, premium fabrics, and limited-edition drops designed to stand out.
                        </p>
                        <div class="hero-actions">
                            <a href="#latest" class="btn-primary">Shop now</a>
                            <a href="#sellers" class="btn-secondary">Explore deals</a>
                        </div>
                        <div class="hero-highlights">
                            <span>Free delivery over $80</span>
                            <span>New arrivals weekly</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="hero-card">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#carouselExampleControls" data-bs-slide-to="1"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="./assets/images/products/Home_2.png" class="d-block w-100" alt="Seasonal jacket collection">
                                </div>
                                <div class="carousel-item">
                                    <img src="./assets/images/products/Home_1.png" class="d-block w-100" alt="Premium outerwear showcase">
                                </div>
                            </div>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <ion-icon name="arrow-forward-circle-outline"></ion-icon>
                            </button>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <ion-icon name="arrow-back-circle-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.hero-section {
    padding: 4rem 0 3rem;
    background: radial-gradient(circle at top left, rgba(79, 70, 229, 0.12), transparent 32%), #fff;
}

.hero-copy h1 {
    font-size: clamp(2rem, 4vw, 3.4rem);
    font-weight: 800;
    line-height: 1.05;
    color: #111827;
    margin-bottom: 1rem;
}

.hero-eyebrow {
    margin: 0 0 0.75rem;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.24em;
    color: #6366f1;
    font-weight: 700;
}

.hero-text {
    font-size: 1.02rem;
    color: #6b7280;
    max-width: 34rem;
    margin-bottom: 1.5rem;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.9rem;
    margin-bottom: 1.2rem;
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.85rem 1.25rem;
    border-radius: 999px;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: #fff;
    box-shadow: 0 10px 24px rgba(79, 70, 229, 0.2);
}

.btn-secondary {
    color: #374151;
    background: #f3f4f6;
}

.btn-primary:hover,
.btn-secondary:hover {
    transform: translateY(-2px);
}

.hero-highlights {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.hero-highlights span {
    padding: 0.5rem 0.8rem;
    border-radius: 999px;
    background: #f9fafb;
    color: #4b5563;
    font-size: 0.9rem;
}

.hero-card {
    padding: 1rem;
    border-radius: 1.5rem;
    background: rgba(255, 255, 255, 0.85);
    box-shadow: 0 24px 60px rgba(17, 24, 39, 0.12);
    backdrop-filter: blur(10px);
}

.carousel img {
    border-radius: 1rem;
    object-fit: cover;
    min-height: 320px;
}

.carousel-control-next,
.carousel-control-prev {
    width: 2.75rem;
    height: 2.75rem;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.95);
    top: 50%;
    transform: translateY(-50%);
    opacity: 1;
    color: #111827;
    box-shadow: 0 10px 20px rgba(17, 24, 39, 0.12);
}

.carousel-control-next {
    right: 1rem;
}

.carousel-control-prev {
    left: 1rem;
}

.carousel-indicators [data-bs-target] {
    background-color: #4f46e5;
}
</style>