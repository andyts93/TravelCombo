import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js', 'resources/js/trip.js', 'resources/js/g-autocomplete.js'],
            refresh: true,
        }),
    ],
});
