const colors = require("tailwindcss/colors.js");
import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        require("./vendor/wireui/wireui/tailwind.config.js"),
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
    ],
    safelist: {
        pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
        variants: ["sm", "md", "lg", "xl", "2xl"],
    },
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./app/livewire/**/*Table.php",
        "./vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php",
        "./vendor/power-components/livewire-powergrid/resources/views/**/*.php",
        "./vendor/wire-elements/modal/resources/views/*.blade.php",
        "./vendor/wire-elements/modal/src/ModalComponent.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: { "pg-primary": colors.indigo },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
    darkMode: "class",
};
