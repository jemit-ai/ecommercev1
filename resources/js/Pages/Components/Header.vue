<template>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./assets/images/logo/logo.png" alt="ShopGrids" width="150px">
            </a>

            <div class="d-flex align-items-center">
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
                        <a class="nav-link" href="#latest">New</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#sellers">Store</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#footer">Contacts</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-flex align-items-center nav-icon" id="fer-bar">
                <ion-icon name="person-outline"></ion-icon>
            </div>
        </div>
    </nav>
</template>

<style scoped>
#nav {
    padding: 1rem 0;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
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

.nav-icon {
    width: 2.4rem;
    height: 2.4rem;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f3f4f6;
    color: #111827;
}
</style>