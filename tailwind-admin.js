const colors = require("tailwindcss/colors");

module.exports = {
  purge: {
    enabled: true,
    content: ["./includes/templates/admin/dashboard.php"],
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
      green: colors.emerald,
      gray: colors.coolGray,
      sky: colors.sky,
    },
  },
  variants: {
    extend: {
      // ...

      backgroundImage: ["hover", "focus"],
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
  ],
}; 
