const webpack = require('webpack')
const path = require('path');

module.exports = function(env) {
    return {
        entry: "./src/js/app.js",
        output: {
            path: path.resolve(__dirname, "dist"),
            filename: "bundle.js",
            // publicPath: '/dist/'
            // publicPath: path.relative('/dist','/wp-content/themes/poncho/dist') + '/'
            publicPath: 'wp-content/themes/poncho/dist/'
        },
        module: {
            loaders: [
                {
                    test: /\.scss$/,
                    loader: 'style-loader!css-loader!resolve-url-loader!sass-loader?sourceMap'
                },
                {
                    test: /\.css$/,
                    loader: "style-loader!css-loader"
                },
                {
                    test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                    loader: 'url-loader?limit=10000&mimetype=application/font-woff'
                },
                {
                    test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                    loader: 'file-loader'
                }
            ]
        },
    }
}