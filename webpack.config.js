/**
 * 安装依赖
 * npm install --save-dev babel-loader babel-core babel-preset-env webpack
 */

const fs = require('fs');
const path = require('path');
const webpack = require('webpack');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const ManifestPlugin = require('webpack-manifest-plugin');

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

let entries = {};

loadFilesFrom(path.resolve('./resources/assets/js')).filter(filename => {
    return !/\/helpers\//.test(filename);
}).filter(filename => {
    return /\.js$/.test(filename);
}).filter(filename => {
    return !/\/(bootstrap)\.js/.test(filename);
}).forEach(filename => {
    let pathname = filename.substr(path.resolve('./resources/assets/js').length+1)

    entries[pathname.substr(0, pathname.length - 3)] = './'+filename.substr(basePath.length+1);
});

module.exports = {
    entry: entries,

    output: {
        path: path.resolve(__dirname, 'public/assets/js'),
        filename: '[name].[chunkhash].js'
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env']
                    }
                }
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.scss$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                ]
            }
        ]
    },
    plugins: [
        new webpack.DllReferencePlugin({
            manifest: path.resolve(__dirname, 'public/assets/js/vendor-manifest.json'),
            context: __dirname
        }),
        new VueLoaderPlugin(),
        // new webpack.optimize.CommonsChunkPlugin({
        //     name: 'runtime'
        // }),
        new ManifestPlugin()
    ]
}
