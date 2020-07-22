const path                    = require('path');
const webpack                 = require('webpack');
const ExtractTextPlugin       = require("extract-text-webpack-plugin");
const UglifyJSPlugin          = require('uglifyjs-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin       = require('browser-sync-webpack-plugin');

const config = {
	entry: {
		app: './assets/js/index.js',
	},
	output: {
		filename: './js/bundle.js', // /public/.js/*
		path: path.resolve(__dirname, 'public'),
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: ExtractTextPlugin.extract({
					fallback: 'style-loader',
				  	use: ['css-loader', 'postcss-loader', 'sass-loader']
				}),
			},
			{
				test: /\.js$/,
				exclude: /(node_modules|bower_components)/,
				loader: 'babel-loader',
				query: {
					presets: ['es2015']
				}
			}
		]
	},
	plugins: [
		new ExtractTextPlugin('../style.css'),
		new BrowserSyncPlugin({
		    proxy: 'localhost/merlin-2017', // CHANGE THIS TO LOCALHOST REL PATH
		    port: 3000,
		    files: [
		        '**/*.php'
		    ],
		    ghostMode: {
		        clicks: false,
		        location: false,
		        forms: false,
		        scroll: false
		    },
		    injectChanges: true,
		    logFileChanges: true,
		    logLevel: 'debug',
		    logPrefix: 'wepback',
		    notify: true,
		    reloadDelay: 0
		})
	]
};

//If true, JS and CSS files will be minified
if (process.env.NODE_ENV === 'production') {
	config.plugins.push(
		new UglifyJSPlugin(),
		new OptimizeCssAssetsPlugin()
	);
}

module.exports = config;
