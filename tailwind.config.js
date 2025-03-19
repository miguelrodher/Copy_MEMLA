import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/*.js',
        './resources/views/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                teal: colors.teal,
                cyan: colors.cyan,
                sky: colors.sky,
                rose: colors.rose,
                blue:colors.blue,
                'memla':{
                    100:'#fef1e8',
                    200:'#fde3d0',
                    300:'#fcd5b9',
                    400:'#fbc7a1',
                    500:'#fab98a',
                    600:'#f9aa73',
                    700:'#f89c5b',
                    800:'#f79211',
                    900:"#f57215",
                },
            },
        },
    },

    plugins: [forms, require('@tailwindcss/typography'), require('@tailwindcss/aspect-ratio'),require('autoprefixer')],

};
