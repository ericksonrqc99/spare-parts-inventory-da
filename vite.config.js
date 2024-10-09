import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    // server: {
    //     host: "0.0.0.0", // Escuchar en todas las interfaces de red
    //     port: 3000, // O cualquier puerto que estés usando
    //     hmr: {
    //         host: "192.168.0.103", // Reemplaza 'tu-ip-local' con la IP local de tu máquina
    //     },
    // },
});
