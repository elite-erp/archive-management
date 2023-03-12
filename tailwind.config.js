const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.blade.php", "./resources/**/*.vue"],
  theme: {
    extend: {
      colors: {
        black: colors.black,
        white: colors.white,
        gray: colors.slate,
        rose: colors.rose,
        primary: colors.blue,
      },
    },
  },
  plugins: [],
};
