/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/vendor/pagination/*.blade.php"
  ],
  theme: {
    screens: {
      'tablet': '640px',
      // => @media (min-width: 640px) { ... }

      'laptop': '1024px',
      // => @media (min-width: 1024px) { ... }

      'desktop': '1280px',
      // => @media (min-width: 1280px) { ... }
    },

    pagination: theme => ({
      color: theme('colors.purple.600'),
      link: 'bg-black',
      linkDisabled: 'bg-black',
      linkFirst: 'mr-6 border rounded bg-black',
      linkSecond: 'rounded-l border-l bg-black',
      linkBeforeLast: 'rounded-r border-r bg-black',
      linkLast: 'ml-6 border rounded bg-black',
  })
  },
  plugins: [
    require('tailwindcss-plugins/pagination')
  ],
}