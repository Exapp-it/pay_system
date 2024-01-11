import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gold: {
                    50: '#fef5e4',
                    100: '#fde7bc',
                    200: '#fcd98d',
                    300: '#fcc55e',
                    400: '#fbb72c',
                    500: '#faa520',
                    600: '#f9900f',
                    700: '#f87c00',
                    800: '#f76800',
                    900: '#f65100',
                },
            },
        },
    },

    plugins: [forms],
};
