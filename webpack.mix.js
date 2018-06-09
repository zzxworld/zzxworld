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
    return !/\/(bootstrap)\.js/.test(filename);
}).forEach(filename => {
    mix.js(filename.substr(basePath.length+1), 'public/js');
});

loadFilesFrom(path.resolve('./resources/assets/sass')).filter(filename => {
    return /^[^_].+\.s?css$/.test(path.basename(filename));
}).forEach(filename => {
    mix.sass(filename.substr(basePath.length+1), 'public/css');
});

if (mix.inProduction()) {
    mix.version();
}

mix.extract(['lodash', 'vue', 'jquery', 'axios']);
