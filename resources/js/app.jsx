import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'; // Importeer de React-plugin

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.jsx'], // Je React entry point
            refresh: true,
        }),
        react(), // Voeg de React-plugin toe
    ],
});
