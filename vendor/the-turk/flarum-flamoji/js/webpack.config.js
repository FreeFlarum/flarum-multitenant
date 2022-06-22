const flarumConfig = require('flarum-webpack-config');
const CopyPlugin = require('copy-webpack-plugin');

let config = flarumConfig();

config.plugins = config.plugins || [];

config.plugins.push(new CopyPlugin([
    
        { 
            from: "dist/vendors~*.js",
            to: "../../assets"
        }
    
]));

module.exports = config;