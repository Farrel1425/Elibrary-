import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
<<<<<<< HEAD
            input: ['resources/css/app.css', 'resources/js/app.js'],
=======
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
            refresh: true,
        }),
    ],
});
