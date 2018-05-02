let mix = require('laravel-mix');

mix.sass('resources/assets/sass/admin.scss', 'public/css');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/notebooks', 'public/js')
   .sass('resources/assets/sass/notebooks.scss', 'public/css');

mix.js('resources/assets/js/task_boards', 'public/js')
   .sass('resources/assets/sass/task_boards.scss', 'public/css');

mix.js('resources/assets/js/tool/segmentword', 'public/js/tool');

mix.js('resources/assets/js/site/admin_index', 'public/js/site');
