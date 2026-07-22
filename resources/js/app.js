import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { defineCustomElements } from 'ionicons/loader' 

import '../css/main.css'; 

// app.js
import 'bootstrap/dist/css/bootstrap.min.css';          // Bootstrap CSS
import 'bootstrap-icons/font/bootstrap-icons.css';      // Icons

import 'bootstrap';                                   // Bootstrap JS (includes Popper)
import $ from 'jquery';                               // jQuery (if you need it)

// Expose jQuery globally for any legacy scripts that expect $ or jQuery
window.$ = window.jQuery = $;

defineCustomElements(window);


createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),

    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
        })
            .use(plugin)
            .mount(el);
    },
});