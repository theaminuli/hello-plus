const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = (env, argv) => {
	const isDevelopment = argv.mode === 'development';
	
	return {
		entry: {
			theme: './src/theme.js',
		},
		output: {
			path: path.resolve(__dirname, 'assets/js'),
			filename: '[name].min.js',
			clean: true,
		},
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: ['@babel/preset-env'],
						},
					},
				},
				{
					test: /\.css$/,
					use: [
						isDevelopment ? 'style-loader' : MiniCssExtractPlugin.loader,
						'css-loader',
					],
				},
			],
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: '../css/[name].min.css',
			}),
		],
		devtool: isDevelopment ? 'source-map' : false,
		mode: isDevelopment ? 'development' : 'production',
		watch: isDevelopment,
		devServer: {
			static: {
				directory: path.join(__dirname, 'assets'),
			},
			compress: true,
			port: 9000,
		},
	};
};