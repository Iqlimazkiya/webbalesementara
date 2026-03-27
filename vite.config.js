import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/user/tipe-unit.css",
                "resources/js/user/tipe-unit.js",
                "resources/css/user/layanan.css",
                "resources/js/user/layanan.js",
                "resources/css/user/navbar.css",
                "resources/js/user/navbar.js",
                "resources/css/admin/dashboard.css",
                "resources/js/admin/dashboard.js",
                "resources/css/admin/main.css",
                "resources/js/admin/main.js",
                "resources/css/admin/sidebar.css",
                "resources/js/admin/sidebar.js",
            ],
            refresh: true,
        }),
    ],
});
