const path = require('path');

module.exports = {
    // The base path of your source files, especially of your index.js
    SRC: path.resolve(__dirname, '..', 'src'),

    // The path to put the generated bundle(s)
    DISTJS: path.resolve(__dirname, '..', 'public', 'js'),
    DISTCSS: path.resolve(__dirname, '..', 'public', 'css'),
    DISTIMG: path.resolve(__dirname, '..', 'public', 'images'),
    DISTFONT: path.resolve(__dirname, '..', 'public', 'fonts'),

    ASSETSJS: '/js',
    ASSETSCSS: '/css',
    ASSETSIMG: '/images',
    ASSETSFONT: '/fonts',
};
