module.exports = {
  purge: {
    enabled: true,
    content: ["./includes/templates/admin*.php"],
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
