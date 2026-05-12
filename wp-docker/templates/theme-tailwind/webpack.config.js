const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
    entry: './assets/js/app.js',
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname, 'assets/dist'),
    },
    mode: 'production',
    optimization: {
        splitChunks: {},
        minimize: false,
        minimizer: [
            new TerserPlugin({
                terserOptions: {
                    compress: {
                        drop_console: true,
                    },
                },
            }),
        ],
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            }
        ]
    }
};