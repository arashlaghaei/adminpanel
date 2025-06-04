import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel(['resources/js/app.js']),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        lib: {
            entry: 'resources/js/app.js',
            name: 'Paginate',
            fileName: 'paginate',
            formats: ['umd']
        },
        outDir: 'public/assets/panel/plugins/paginate', // مسیر خروجی دلخواهت
        rollupOptions: {
            external: ['vue', 'axios'],
            output: {
                globals: {
                    vue: 'Vue',
                    axios: 'axios'
                }
            }
        },
        emptyOutDir: true, // پوشه خروجی رو خالی کن
        minify: false, // برای تست
        manifest: false, // فایل manifest.json رو تولید نکن
        assetsDir: '', // از تولید پوشه assets جلوگیری کن
    }
});