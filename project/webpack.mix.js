const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.js('resources/assets/js/app.js', 'public/js');

mix.sass('resources/assets/scss/app.scss', 'public/css')
  .options({
    processCssUrls: false,
    postCss: [
      tailwindcss('./tailwind.js'),
    ],
  });
