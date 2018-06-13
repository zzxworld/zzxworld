/**
 * 安装依赖
 * npm install --save-dev babel-loader babel-core babel-preset-env webpack
 */

const path = require('path');
const webpack = require('webpack');

module.exports = {
    entry: {
        main: './resources/assets/js/app.js',
        // vendor: ['lodash', 'vue', 'axios', 'jquery', 'bootstrap-sass', 'sweetalert'],
    },
    output: {
        path: path.resolve(__dirname, 'public/assets'),
        filename: '[name].js'
        // filename: '[name].[chunkhash].js'
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
            }
        ]
    },
    plugins: [
        new webpack.DllReferencePlugin({
            manifest: path.resolve(__dirname, 'public/assets/dll-manifest.json'),
            context: __dirname
        }),
        // new webpack.optimize.CommonsChunkPlugin({
        //     name: 'vendor'
        // }),
        new webpack.optimize.CommonsChunkPlugin({
            name: 'runtime'
        })
    ]
}
