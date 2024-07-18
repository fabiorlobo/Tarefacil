const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const glob = require('glob');
const webpack = require('webpack');
const dotenv = require('dotenv');

dotenv.config();

const scriptEntries = glob.sync('./resources/assets/scripts/**/*.js').reduce((acc, filePath) => {
	const entry = path.basename(filePath, path.extname(filePath));
	acc[entry] = path.resolve(__dirname, filePath);
	return acc;
}, {});

const styleEntries = glob.sync('./resources/assets/styles/**/*.scss').reduce((acc, filePath) => {
	const entry = path.basename(filePath, path.extname(filePath));
	acc[entry] = path.resolve(__dirname, filePath);
	return acc;
}, {});

module.exports = {
	entry: {
		...scriptEntries,
		...styleEntries
	},
	output: {
		filename: 'scripts/[name].js',
		path: path.resolve(__dirname, 'public/assets')
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env']
					}
				}
			},
			{
				test: /\.scss$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [
									require('autoprefixer')
								]
							}
						}
					},
					'sass-loader'
				]
			}
		]
	},
	resolve: {
		extensions: ['.js', '.scss']
	},
	optimization: {
		minimize: true,
		minimizer: [
			new TerserPlugin({
				extractComments: false,
			})
		]
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: 'styles/[name].css'
		}),
		new webpack.DefinePlugin({
			'process.env': JSON.stringify(process.env)
		})
	],
	watch: true,
	stats: {
		errorDetails: true
	}
};