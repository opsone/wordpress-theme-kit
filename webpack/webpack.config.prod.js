const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const CompressionPlugin = require("compression-webpack-plugin");
const ImageminWebpackPlugin = require('imagemin-webpack-plugin').default;
const ImageminPngquant = require('imagemin-pngquant');
const ImageminJpegoptim = require('imagemin-jpegoptim');
const ImageminSvgo = require('imagemin-svgo');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const autoprefixer = require('autoprefixer');
const { exec } = require('child_process');

exec('cd ./scripts;php version.php');

module.exports = {
  devtool: 'sourcemap',

  output: {
    path: path.resolve(__dirname, '../dist'),
  },

  module: {
    rules: [
      {
        test: /\.(css)$/i,
        loader: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            { loader: 'css-loader', options: {
              minimize: true,
              url: false,
              importLoaders: 1,
              sourceMap: true
            }},
            { loader: 'postcss-loader', options: {
              ident: 'postcss',
              sourceMap: true,
              outputStyle: 'expanded',
              plugins: () => [
                autoprefixer()
              ]
            }},
            { loader: 'sass-loader', options: { sourceMap: true } }
          ]
        })
      }
    ]
  },

   plugins: [
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: true,
      compress: {
        warnings: false
      },
      output: {
        comments: false
      }
    }),
    new CopyWebpackPlugin([
        {from: 'app/front/files', to: 'files'},
    ]),
    new ExtractTextPlugin("css/style.css"),
    new OptimizeCssAssetsPlugin({
      assetNameRegExp: /\.css$/,
      cssProcessorOptions: { discardComments: { removeAll: true }, zindex: false }
    }),
    // for image use in website
    new ImageminWebpackPlugin({
      plugins: [
        ImageminPngquant(),
        ImageminSvgo(),
        ImageminJpegoptim({
          progressive: true,
          max: 75
        }),
      ]
    }),
    new CompressionPlugin({
      asset: "[path].gz[query]",
      algorithm: "gzip",
      test: /\.(js|css)$/,
      threshold: 10240,
      minRatio: 0.8
    })
  ]
}
