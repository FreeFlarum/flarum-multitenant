// copy necessary files and directories with webpack
// more info on https://github.com/webpack-contrib/copy-webpack-plugin

const flarumConfig = require('flarum-webpack-config');
const CopyPlugin = require('copy-webpack-plugin');

let config = flarumConfig();

config.plugins = config.plugins || [];

config.plugins.push(new CopyPlugin([
	{
		from: 'node_modules/codemirror/theme',
		to: '../../assets/codemirror'
	},
  {
		from: 'node_modules/codemirror/lib/codemirror.css',
		to: '../../assets/codemirror/codemirror.css'
	},
  {
		from: 'node_modules/@simonwep/pickr/dist/themes/monolith.min.css',
		to: '../../assets/pickr/monolith.min.css'
	}
]));

module.exports = config;
