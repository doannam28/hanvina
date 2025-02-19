import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';
import { createRequire } from 'node:module';
const require = createRequire( import.meta.url );

export default defineConfig({
    build: {
        outDir: 'dist',
    },
    server: {
        port: 3000,
    },
    plugins: [
        ckeditor5( { theme: require.resolve( '@ckeditor/ckeditor5-theme-lark' ) } ),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/ckeditor.js', // Đảm bảo rằng bạn có tệp này
            ],
            refresh: true,
        }),
    ],
});
