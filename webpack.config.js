// PATH
const path = require("path");
const webpack = require("webpack");
const SRC_DIR = path.resolve(__dirname, "./resources/assets/js");
const DIST_DIR = path.resolve(__dirname, "./resources/assets/js");
const BUNDLE_DIR = path.resolve(__dirname, "./resources/assets/bundle");
// PLUGIN
const copyPlugin = require('copy-webpack-plugin');

const assets = require(SRC_DIR + "/assets");

module.exports = {
    entry: SRC_DIR + "/index.js",
    // entry: [
    //     SRC_DIR + "/sweetalert2.all.js",
    //     SRC_DIR + "/prueba2.js"
    // ],
    // entry: {
    //     sweetalert2: SRC_DIR + "/sweetalert2.all.js",
    //     fontawesome: SRC_DIR + "/all.min.js"
    // },
    output: {
        filename: 'bundle.js',
        path: BUNDLE_DIR,
        chunkLoading: false,
        wasmLoading: false,
    },
    plugins: [
        new copyPlugin({
            patterns: assets.map(assets => {
                return {
                    from: path.resolve(__dirname, `./node_modules/${assets}`),
                    to: path.resolve(__dirname, DIST_DIR),
                }
            })
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        })

    ]
};