import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {

            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },

            colors: {
                layanan: {
                    bg: "#e9f1ea",
                    primary: "#3f5f47",
                    secondary: "#5f7f66",
                    tertiary: "#7fa78b",
                    quaternary: "#b7d1c0",
                    dark: "#2f4f3a",
                    light: "#c9d8cc",
                },
            },

            keyframes: {
                fadeUp: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(40px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)'
                    }
                }
            },

            animation: {fadeUp: 'fadeUp 1.6s ease-out both'}


            
        },
    },

    plugins: [forms],
};