const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'marquee-slower': 'marquee 30s linear infinite',
                'marquee': 'marquee 27s linear infinite',
                'marquee-faster': 'marquee 15s linear infinite',
                'scroll-slower': 'scroll 15s linear infinite',
            },
            keyframes: {
                marquee: {
                  '0%': { transform: 'translateX(100%)' },
                  '100%': { transform: 'translateX(0)' },
                }
            }
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.trueGray,
            indigo: colors.indigo,
            red: colors.red,
            amber: colors.amber,
            yellow: colors.yellow,
            green: colors.green,
        },
    },

    important: true,

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
