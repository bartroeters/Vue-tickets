import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            'style': path.resolve(__dirname, './resources/css/style'),
            '@': path.resolve(__dirname, './resources/js'),
            'components': path.resolve(__dirname, './resources/js/components'),
            'domains': path.resolve(__dirname, './resources/js/domains'),
            'routes': path.resolve(__dirname, './resources/js/routes'),
            'services': path.resolve(__dirname, './resources/js/services'),
            'get-formatted-content': path.resolve(
                __dirname,
                './resources/js/components/shared-components/overview-components/get-formatted-content.ts'
            ),
        },
    },
});
