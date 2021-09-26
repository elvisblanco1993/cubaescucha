const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
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
                logo: ['Merriweather', 'sans-serif'],
            },
            animation: {
                'marquee-slower': 'marquee 30s linear infinite',
                'marquee': 'marquee 27s linear infinite',
                'marquee-faster': 'marquee 15s linear infinite',
                'scroll-slower': 'scroll 15s linear infinite',
                'blob': "blob 7s infinite"
            },
            keyframes: {
                marquee: {
                  '0%': { transform: 'translateX(100%)' },
                  '100%': { transform: 'translateX(0)' },
                },
                blob: {
                    "0%": {
                        transform: "translate(0px, 0px) scale(1)",
                    },
                    "33%": {
                        transform: "translate(30px, -40px) scale(1.1)",
                    },
                    "66%": {
                        transform: "translate(-20px, 20px) scale(0.9)",
                    },
                    "100%": {
                        transform: "translate(0px, 0px) scale(1)",
                    },
                }
            }
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.coolGray,
            bluegray: colors.blueGray,
            indigo: colors.indigo,
            red: colors.red,
            amber: colors.amber,
            yellow: colors.yellow,
            green: colors.green,
            purple: colors.purple,
            emerald: colors.emerald
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
