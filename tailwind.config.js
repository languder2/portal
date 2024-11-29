import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            margin: {
                '18rem'     : '18rem',
                '19rem'     : '19rem',
            },
            width: {
                '18rem'     : '18rem',
            },
            colors: {
                baseRed     : '#820000',
                test        : '#777700',
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
