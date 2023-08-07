/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // "./index.html",
    // "./src/**/*.{js,ts,jsx,tsx}",
    './storage/framework/views/*.vue',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.{js,vue}',

],
  theme: {
    extend: {},
  },
// tailwind.config.js
plugins: [
    require("@tailwindcss/forms")
    //  ({
    //   strategy: 'base', // only generate global styles
    //   strategy: 'class', // only generate classes
    // }),
  ],
}

