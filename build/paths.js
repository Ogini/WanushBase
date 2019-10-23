const path = require('path');

module.exports = {
    // The base path of your source files, especially of your index.js
    SRC: path.resolve(__dirname, '..', 'src'),

    // The path to put the generated bundle(s)
    DISTJS: path.resolve(__dirname, '..', 'public', 'js'),
    DISTCSS: '../css',
    DISTIMG: '../images',
    DISTFONT: '../fonts',

    ASSETSJS: '/js',
    ASSETSIMG: '/images',
};
