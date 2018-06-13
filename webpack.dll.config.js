const path = require('path');
const webpack = require('webpack');

module.exports = {
    entry: {
        vendor: ['lodash', 'vue', 'axios', 'jquery', 'bootstrap-sass', 'sweetalert'],
    },
    output: {
        path: path.resolve(__dirname, 'public/assets'),
        filename: 'dll.js',
        library: '[name]'
    },
    plugins: [
        new webpack.DllPlugin({
            path: path.resolve(__dirname, 'public/assets/dll-manifest.json'),
            name: '[name]',
            context: __dirname
        })
    ]
}
