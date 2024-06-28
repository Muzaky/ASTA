const mix = require('laravel-mix');

require('dotenv').config();

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .webpackConfig({
      plugins: [
         new webpack.EnvironmentPlugin({
            MIX_PUSHER_APP_KEY: JSON.stringify(process.env.PUSHER_APP_KEY),
            MIX_PUSHER_APP_CLUSTER: JSON.stringify(process.env.PUSHER_APP_CLUSTER),
            MIX_PUSHER_HOST: JSON.stringify(process.env.PUSHER_HOST),
            MIX_PUSHER_PORT: JSON.stringify(process.env.PUSHER_PORT),
            MIX_PUSHER_SCHEME: JSON.stringify(process.env.PUSHER_SCHEME),
         }),
      ],
   });