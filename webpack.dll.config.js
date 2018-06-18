const path = require('path');
const webpack = require('webpack');

module.exports = {
    entry: {
        vendor: ['lodash', 'vue', 'axios', 'jquery', 'bootstrap-sass', 'sweetalert', 'codemirror', 'moment'],
    },
    output: {
        path: path.resolve(__dirname, 'public/assets/js'),
        filename: 'vendor.js',
        library: '[name]'
    },
    plugins: [
        new webpack.DllPlugin({
            path: path.resolve(__dirname, 'public/assets/js/vendor-manifest.json'),
            name: '[name]',
            context: __dirname
        })
    ]
}
