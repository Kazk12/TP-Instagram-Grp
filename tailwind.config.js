/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'index.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        logo: ["Poppins", "sans-serif"],
        main: ["Inter", "sans-serif"],
      },
      colors : {
        "violet": "#3a0ca3",
      }
    },
  },
  plugins: [],
}

