<template>
    <section class="up_footer">
        <div class="container py-4">
            <div class="row g-3">
                <div class="col-6 col-md-3 text-center">
                    <i class="bi bi-truck"></i>
                    <p>Free shipping & easy returns</p>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <i class="bi bi-cash-coin"></i>
                    <p>100% money-back guarantee</p>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <i class="bi bi-arrow-repeat"></i>
                    <p>Fast replacements for defects</p>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <i class="bi bi-shield-lock"></i>
                    <p>Secure checkout</p>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container py-5">
            <div class="row gy-4">
                <div class="col-12 col-md-3 text-center text-md-start">
                    <img src="./assets/images/logo/white-logo.png" width="160px" alt="ShopGrids" />
                </div>
                <div class="col-12 col-md-3 text-center text-md-start">
                    <h3>Help & info</h3>
                    <ul>
                        <li>Help center</li>
                        <li>Back orders</li>
                        <li>Delivery & returns</li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 text-center text-md-start">
                    <h3>About us</h3>
                    <ul>
                        <li>Our story</li>
                        <li>Careers</li>
                        <li>Investor info</li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 text-center text-md-start">
                    <h3>More from us</h3>
                    <ul>
                        <li>Mobile app</li>
                        <li>Gift cards</li>
                        <li>Black Friday</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <div class="socket text-center py-4">
        <p>
            © 2026 ShopGrids. All rights reserved.<br />
            <span>Designed with care by <a href="https://ahmedabdalalim.pages.dev/">3A</a></span>
        </p>
    </div>
</template>

<style scoped>
.up_footer {
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
}

.up_footer i {
    font-size: 1.5rem;
    color: #4f46e5;
    margin-bottom: 0.5rem;
}

.up_footer p {
    margin: 0;
    color: #4b5563;
    font-size: 0.95rem;
}

footer {
    background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
    color: #f9fafb;
}

footer h3 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
}

footer ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

footer li {
    margin-bottom: 0.5rem;
    color: #cbd5e1;
}

.socket {
    background: #0f172a;
    color: #cbd5e1;
}

.socket a {
    color: #fff;
    text-decoration: none;
}
</style>