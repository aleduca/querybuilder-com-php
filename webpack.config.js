const path = require("path");

const publicPath = path.resolve(__dirname, "public");

module.exports = {
    mode: process.env.NODE_ENV,
    entry: {
        login: publicPath + "/assets/login.js",
    },
    output: {
        path: publicPath + "/dist",
        filename: "[name].js",
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ["@babel/preset-env"],
                    },
                },
            },
        ],
    },
};
