import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                uma: {
                    green: '#00B764',
                    teal: '#0d9488',
                    gold: '#f59e0b',
                    sky: '#38bdf8',
                },
            },
            boxShadow: {
                'uma': '0 4px 24px -4px rgba(0, 183, 100, 0.2)',
                'uma-lg': '0 8px 32px -4px rgba(0, 183, 100, 0.3)',
            },
        },
    },

    plugins: [forms],
};
