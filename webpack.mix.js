const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');
const webpack = require('webpack');

const loadFilesFrom = (folder) => {
    let files = [];
    let resources = fs.readdirSync(folder);

    resources.forEach(filename => {
        let filepath = path.resolve(folder, filename);

        if (fs.statSync(filepath).isDirectory()) {
            files = files.concat(loadFilesFrom(filepath));
        } else {
            files.push(filepath);
        }
    });

    return files;
};

const basePath = path.resolve('./');

loadFilesFrom(path.resolve('./resources/assets/js')).filter(filename => {
    return /\.js$/.test(filename);
}).filter(filename => {
    return !/\/(bootstrap|js\/app)\.js/.test(filename);
}).forEach(filename => {
    let pathname = path.dirname(filename.substr(path.resolve('./resources/assets/js').length+1))
    mix.js(filename.substr(basePath.length+1), 'public/js/'+pathname);
});

mix.js('resources/assets/js/app.js', 'public/js');

loadFilesFrom(path.resolve('./resources/assets/sass')).filter(filename => {
    return /^[^_].+\.s?css$/.test(path.basename(filename));
}).forEach(filename => {
    let pathname = path.dirname(filename.substr(path.resolve('./resources/assets/sass').length+1))
    mix.sass(filename.substr(basePath.length+1), 'public/css/'+pathname);
});

if (mix.inProduction()) {
    mix.version();
}

mix.extract(['lodash', 'sweetalert', 'vue', 'jquery', 'axios']);
