/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './vendor/jaocero/filachat/resources/views/**/**/*.blade.php',
        './vendor/wireui/breadcrumbs/src/Components/**/*.php',
        './vendor/wireui/breadcrumbs/src/views/**/*.blade.php',
        './vendor/ralphjsmit/laravel-filament-onboard/resources/**/*.blade.php',
        'node_modules/preline/dist/*.js',
        './resources/views/cms/theme/default/components/templates/*.blade.php'
    ],
    safelist: [
        'bg-[#1d71b8]',
        'from-[#1d71b8]',
        'via-[#1d71b8]',
        'text-[#1d71b8]',

        'bg-[#ef485c]',
        'from-[#ef485c]',
        'via-[#ef485c]',

        'bg-[#fbad1e]',
        'from-[#fbad1e]',
        'via-[#fbad1e]',


        'bg-[#50c1b7]',
        'from-[#50c1b7]',
        'via-[#50c1b7]',


    ],
    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'spinoo': 'spin360 100s infinite',
            },
            keyframes: {
                spin360: {
                    from: {
                        transform: 'rotate(0deg)',
                    },
                    to: {
                        transform: 'rotate(360deg)',
                    }
                }
            },
            colors: {
                'primary-1': '#3cc7bc',
                'bg-primary-2': '#1d71b8',
                'brand-blue': '#1d71b8',
                'brand-red': '#ef485c',
                'brand-yellow': '#fbad1e',
                'brand-gray': '#949d91',
                'brand-green': '#50c1b7',
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('preline/plugin'),
    ],
    darkMode: 'false',
};
