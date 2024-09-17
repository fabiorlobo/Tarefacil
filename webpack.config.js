const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const glob = require('glob');
const webpack = require('webpack');
const dotenv = require('dotenv');

dotenv.config();

const styleEntries = glob.sync('./resources/assets/styles/**/*.scss').reduce((acc, filePath) => {
	if (!filePath.includes('/_')) {
		const entry = path.basename(filePath, path.extname(filePath));
		acc[entry] = path.resolve(__dirname, filePath);
	}
	return acc;
}, {});

const scriptEntries = glob.sync('./resources/assets/scripts/**/*.js').reduce((acc, filePath) => {
	const entry = path.basename(filePath, path.extname(filePath));
	acc[entry] = path.resolve(__dirname, filePath);
	return acc;
}, {});

module.exports = {
	entry: {
		...scriptEntries,
		...styleEntries,
		app: path.resolve(__dirname, './resources/assets/scripts/app.js')
	},
	output: {
		filename: 'scripts/[name].js',
		path: path.resolve(__dirname, 'public/assets')
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'sass-loader'
				]
			},
			{
				test: /\.(woff|woff2|eot|ttf|otf)$/,
				type: 'asset/resource',
				generator: {
					filename: 'fonts/[name][ext]'
				}
			}
		]
	},
	resolve: {
		extensions: ['.js', '.scss']
	},
	optimization: {
		minimize: false,
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: 'styles/[name].css'
		}),
		new webpack.DefinePlugin({
			'process.env': JSON.stringify(process.env)
		}),
		new CopyWebpackPlugin({
			patterns: [
				{
					from: path.resolve(__dirname, 'resources/assets/scripts'),
					to: path.resolve(__dirname, 'public/assets/scripts')
				},
				{
					from: path.resolve(__dirname, 'resources/assets/images'),
					to: path.resolve(__dirname, 'public/assets/images')
				}
			]
		}),
		new ImageMinimizerPlugin({
			test: /\.(png|jpe?g|gif|svg)$/i,
			minimizer: {
				implementation: ImageMinimizerPlugin.imageminMinify,
				options: {
					plugins: [
						['optipng', { optimizationLevel: 5 }],
						[
							'svgo',
							{
								plugins: [
									{
										name: 'preset-default',
										params: {
											overrides: {
												removeTitle: false,
												removeDesc: false,
												removeViewBox: false,
												mergePaths: false,
												cleanupIDs: {
													prefix: {
														toString() {
															return `${Math.random().toString(36).substr(2, 9)}`;
														}
													},
													minify: true
												},
												removeUnknownsAndDefaults: {
													keepDataAttrs: false
												}
											}
										}
									}
								]
							}
						],
					],
				},
			},
		}),
	],
	watch: true,
	stats: {
		errorDetails: true
	}
};

//npx webpack --mode production