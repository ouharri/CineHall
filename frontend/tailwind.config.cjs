/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')
module.exports = {
  darkMode: 'class',
  content: [
    './index.html',
    './src/**/*.{vue,js}',
    './node_modules/flowbite/**/*.js',
    './node_modules/sweetalert/**/*.js',
    './node_modules/sweetalert/**/*.css',
  ],
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}','./node_modules/sweetalert/**/*{vue,js,ts,jsx,tsx}'],
  theme: {
    screens: {
      xs: '350px',
      ...defaultTheme.screens,
    },
    extend: {
      colors: {},
      fontFamily: {
        montserrat: ['Montserrat', 'sans-serif'],
        poppins: ['Poppins', 'sans-serif'],
      },
      fontSize: {
        xxs: '.65rem',
      },
      boxShadow: {
        '3xl': '10 35px 60px 15px rgba(255, 1, 0, 0.3)',
      },
    },
  },
  plugins: [
    // require('tailwindcss-dark-mode')(),
    require('flowbite/plugin'),
    require('tailwind-scrollbar'),
  ],
}
