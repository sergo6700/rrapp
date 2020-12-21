const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');
const webpack = require('webpack');

// const CleanWebpackPlugin = require('clean-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
const { resolve } = require('path');
const { path } = require('app-root-path');

const SOURCE_DIRECTORY = resolve(path, './');

const environment = process.env.NODE_ENV

mix.setPublicPath('public').mergeManifest();

mix.js('resources/js/app.js', 'public/js').version();
mix.sass('resources/sass/app.sass', 'public/css').version();

if (environment !== 'production') {
	mix.sourceMaps();
	mix.webpackConfig({ devtool: "inline-source-map" });
}

mix.browserSync({
	proxy: 'rrapp.loc'
});

mix.webpackConfig({
	output: {
		publicPath: '/',
		chunkFilename: 'js/app_[name]_[hash:5].js'
	},
	resolve: {
		extensions: ['.js', '.vue', '.json'],
		alias: {
			'@': __dirname + '/resources/js'
		},
	},
	devServer: {
		// public: "localhost:8080",
		// contentBase: "./public",
		hot: true,
		watchOptions: {
		  poll: true
		}
	  },
	plugins: [
		new CleanWebpackPlugin({
			verbose: true,
			root: SOURCE_DIRECTORY,
			cleanOnceBeforeBuildPatterns: ['!**/*', 'js/app*.*'],
		}),
		// new BundleAnalyzerPlugin({
		//     analyzerMode: 'disabled',
		//     openAnalyzer: false,
		//     generateStatsFile: true,
		// }),
		new webpack.ContextReplacementPlugin(
			/moment[/\\]locale$/, /(ru)/
		)
	],
	module: {
		rules: [
		  { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" }
		]
	  }
});
