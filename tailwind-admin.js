const colors = require("tailwindcss/colors");

module.exports = {
  purge: {
    enabled: false,
    content: ["./includes/templates/admin/*.php"],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    colors: {
      // Build your palette here
      transparent: "transparent",
      current: "currentColor",
      black: colors.black,
      white: colors.white,
      red: colors.red,
      green: colors.green,
      gray: colors.coolGray,
      sky: colors.sky,
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require("@tailwindcss/forms")({
      strategy: "class",
    }),
  ],
}; 
