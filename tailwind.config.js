/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js}"], 
  theme: {
    extend: {
      fontFamily: {
        iceland: ['"Iceland"', 'sans-serif'],
      },
    },
  },
  plugins: [],
}