const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
          fontFamily: {
            display: ['Inter', 'system-ui', 'sans-serif'],
            body: ['Inter', 'system-ui', 'sans-serif'],
          },
          colors: {
            primary: {
              50:  '#fa9d9d',
              100: '#f78f8e',
              200: '#f3827f',
              300: '#ef746f',
              400: '#ea665f',
              500: '#e4584f',
              600: '#de493f',
              700: '#d7392f',
              800: '#cf261d',
              900: '#c70808',
            },
            secondary: {
              50:  '#c9f3ba',
              100: '#bef2ab',
              200: '#b2f19c',
              300: '#a6ef8d',
              400: '#99ee7d',
              500: '#8cec6d',
              600: '#7eeb5c',
              700: '#6ee949',
              800: '#5ce732',
              900: '#46e50c',
            },
            gray: {
              50:  '#848484',
              100: '#747474',
              200: '#656565',
              300: '#565656',
              400: '#484848',
              500: '#3a3a3a',
              600: '#2d2d2d',
              700: '#202020',
              800: '#141414',
              900: '#000000',
            },
            light: {
              50:  '#ffffff',
              100: '#f1f1f1',
              200: '#e2e2e2',
              300: '#d4d4d4',
              400: '#c7c7c7',
              500: '#b9b9b9',
              600: '#ababab',
              700: '#9e9e9e',
              800: '#919191',
              900: '#848484',
            },
          },
          spacing: {
            '128': '32rem',
            '144': '36rem',
          },
          borderRadius: {
            '4xl': '2rem',
          }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
