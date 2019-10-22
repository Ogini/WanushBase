const path = require('path');
const {SRC, DISTJS, DISTCSS, DISTIMG, DISTFONT, ASSETSJS, ASSETSCSS, ASSETSIMG, ASSETSFONT} = require('./paths');
const webpack = require('webpack');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const babelLoader = {
    loader: 'babel-loader',
    options: {
        cacheDirectory: true
    }
};
const cssExtractLoader = {
    loader: MiniCssExtractPlugin.loader,
    options: {
        outputPath: DISTCSS,
    }
};
const cssLoader = { loader: 'css-loader' };
const sassLoader = { loader: 'sass-loader' };
const imageFileLoader = {
    loader: 'file-loader',
    options: {
        name: '[name]-[hash:6].[ext]',
        outputPath: DISTIMG
    }
};
const fontFileLoader = {
    loader: 'file-loader',
    options: {
        name: '[name]-[hash:6].[ext]',
        outputPath: DISTFONT
    }
};

module.exports = {
    entry: {
        main: path.resolve(SRC, 'JavaScript', 'index.js'),
    },
    output: {
        // Put all the bundled stuff in your dist folder
        path: DISTJS,

        // Our single entry point from above will be named "scripts.js"
        filename: '[name].js',

        // The output path as seen from the domain we're visiting in the browser
        publicPath: ASSETSJS
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: babelLoader
            },
            {
                test: /\.css$/,
                use: [ cssExtractLoader, cssLoader ]
            },
            {
                test: /\.scss$/,
                use: [ cssExtractLoader, cssLoader, sassLoader ]
            },
            {
                test: /\.(png|jpg|jpeg|gif|ico|svg)$/,
                use: [ imageFileLoader ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: [ fontFileLoader ]
            }
        ]
    },
    optimization: {
        splitChunks: {
            chunks: 'all'
        }
    },
    plugins: [
        new webpack.ProvidePlugin({
            jQuery: 'jquery',
            $: 'jquery',
            popper: 'popper.js',
            bootstrap: 'bootstrap'
        }),
        new CopyWebpackPlugin([
            {from: './src/assets/static', to: '../static'}
        ]),
        new MiniCssExtractPlugin({
            filename: '../css/[name].css',
            chunkFilename: '../css/[id].css',
            ignoreOrder: false
        })
    ]
};
