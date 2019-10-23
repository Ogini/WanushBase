const path = require('path');
const {SRC, DISTJS, DISTCSS, DISTIMG, DISTFONT, ASSETSJS, ASSETSIMG} = require('./paths');
const webpack = require('webpack');
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
        name: '[name].[ext]',
        outputPath: DISTIMG,
        publicPath: ASSETSIMG
    }
};
const imageSizeLoader = {
    loader: 'image-webpack-loader',
    options: {
        mozjpeg: {
            progressive: true,
            quality: 65
        },
        // optipng.enabled: false will disable optipng
        optipng: {
            enabled: false,
        },
        pngquant: {
            quality: [0.65, 0.90],
            speed: 10
        },
        gifsicle: {
            interlaced: false,
        },
        // the webp option will enable WEBP
        webp: {
            quality: 75
        }
    }
};
const fontFileLoader = {
    loader: 'file-loader',
    options: {
        name: '[name].[ext]',
        outputPath: DISTFONT
    }
};

module.exports = {
    entry: {main: path.resolve(SRC, 'JavaScript', 'index.js')},
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
                use: [ imageFileLoader, imageSizeLoader ]
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
        new MiniCssExtractPlugin({
            filename: '../css/[name].css',
            chunkFilename: '../css/[id].css',
            ignoreOrder: false
        })
    ]
};
