const path = require('path');
const webpack = require('webpack');
const { merge } = require('webpack-merge');
const FileManagerPlugin = require('filemanager-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = merge(
  require('flarum-webpack-config')(),
  {
    output: {
      chunkFilename: 'chunk~[name].js',
    },
    plugins: [
      new CleanWebpackPlugin({
        dry: false,
        dangerouslyAllowCleanPatternsOutsideProject: true,
        cleanOnceBeforeBuildPatterns: [path.resolve(process.cwd(), '../assets/*'), path.resolve(process.cwd(), 'dist/*')],
      }),
      new FileManagerPlugin({
        events: {
          onEnd: {
            copy: [{ source: 'dist/chunk*', destination: '../assets/' }],
          },
        },
      }),
    ],
  }
);
