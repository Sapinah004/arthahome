/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./pages/**/*.{php, css, js}', './core/**/*.php', "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      fontFamily: {
        playfair: "'Playfair Display', serif",
        yantramanav : "'Yantramanav', sans-serif"
      },
      colors : {
        primary : "#032B4D",
        secondary : "#CA9D21",
        blueMain : "#E8F1FF"
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
