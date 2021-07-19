module.exports = {
  purge: {
    enabled: true,
    content: ["./includes/templates/public*"],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms")],
};
