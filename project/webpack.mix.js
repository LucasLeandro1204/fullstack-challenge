const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

const paths = {
  js: path.join(__dirname, 'resources/assets/js'),
  scss: path.join(__dirname, 'resources/assets/scss'),
};

mix.webpackConfig({
  resolve: {
    alias: {
      'core': path.join(paths.js, 'core'),
      '@': path.join(paths.js, 'components'),
    },
  },
});

mix.js(path.join(paths.js, 'app.js'), 'public/js');

mix.sass(path.join(paths.scss, 'app.scss'), 'public/css')
  .options({
    processCssUrls: false,
    postCss: [
      tailwindcss('./tailwind.js'),
    ],
  });
