/**
 * 安装依赖
 * npm install --save-dev babel-loader babel-core babel-preset-env webpack
 */

const path = require('path');

module.exports = {
    entry: './resources/assets/js/app.js',
    output: {
        path: path.resolve(__dirname, 'public/assets'),
        filename: '[name].js'
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
    }
}
