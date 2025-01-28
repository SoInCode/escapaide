import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/accessibility.js',
                'resources/css/app.css',
                'resources/js/widget.js',
                'resources/css/styleFrontOfficeHomepage.css',
                'resources/css/styleFrontOfficeNavbar.css',
                'resources/css/styleFrontOfficeFooter.css',
                'resources/css/styleFrontOfficeTemplate.css',
                'resources/css/styleBackOfficeHomepage.css',
                'resources/css/styleBackOfficeNavbar.css',
                'resources/css/styleBackOfficeTemplate.css',
                'resources/css/meteo.css'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
                  '@': '/resources/js'
        },
    },
});
