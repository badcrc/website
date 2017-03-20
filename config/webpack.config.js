var ManifestPlugin    = require('webpack-manifest-plugin');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var webpack           = require("webpack");
const extractCSSVue = new ExtractTextPlugin('/css/comp.css');
const extractCSS    = new ExtractTextPlugin('/css/core.css');

module.exports = {
    entry: {
        app: [__dirname + '/../src/front/main.js', __dirname + '/../assets/scss/main.scss'],
    },
    output: {
        filename: "js/bundle.js",
        path: __dirname + '/../assets/dist',
        publicPath: '/'
    },
    module: {
        // module.rules is the same as module.loaders in 1.x
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        css: extractCSSVue.extract({
                            use: 'css-loader',
                            fallback: 'vue-style-loader' // <- this is a dep of vue-loader, so no need to explicitly install if using npm3
                        })
                    }
                }
            },
            {
                test: /\.css$/,
                loaders: extractCSS.extract({
                    fallback: "style-loader",
                    use: "css-loader"
                })
            },{
                test: /\.scss$/,
                use: extractCSS.extract({
                    use: [{
                        loader: "css-loader"
                    }, {
                        loader: "sass-loader"
                    }],
                    fallback: "style-loader"
                })
            },
            {
                test: /\.(eot|woff|woff2|ttf|svg|png|jpe?g|gif)(\?\S*)?$/,
                loader: 'raw-loader'
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: '/node_modules/'
            }
        ]
    },
    plugins: [
        new ManifestPlugin(),
        extractCSS,
        extractCSSVue
    ]
};

