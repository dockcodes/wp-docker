const MiniCssExtractPlugin = require("mini-css-extract-plugin");
var path = require("path");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require('terser-webpack-plugin');

const jsPath = "./assets/js";
const outputPath = "./assets/dist";
const scssPath = "./assets/scss";

const appConfig = {
    entry: {
        app: jsPath + "/app.js",
        style: scssPath + "/app.scss",
    },
    output: {
        filename: "[name].js", // Plik 'app.js' trafi do /dist/js/app.js
        path: path.resolve(__dirname, outputPath), // Ścieżka wyjściowa dla 'app'
    },
    optimization: {
        splitChunks: {},
        minimize: false,
        minimizer: [
            new CssMinimizerPlugin(),
            new TerserPlugin({
                terserOptions: {
                    compress: {
                        drop_console: true,
                    },
                },
            }),
        ],
    },
    mode: "production",
    plugins: [
        new MiniCssExtractPlugin({
            filename: "[name].css",
        }),
    ],
    module: {
        rules: [
            {
                test: /\.s?[c]ss$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
            },
            {
                test: /\.sass$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    "css-loader",
                    {
                        loader: "sass-loader",
                        options: {
                            sassOptions: {
                                indentedSyntax: true,
                                quietDeps: true,
                            },
                        },
                    },
                ],
            },
            {
                test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
                type: "asset/resource",
                generator: {
                    filename: "[hash][ext][query]",
                },
            },
        ],
    },
};

module.exports = [appConfig];