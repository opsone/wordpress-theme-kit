const webpack = require('webpack');
const path = require('path');
const WriteFilePlugin = require('write-file-webpack-plugin');
const autoprefixer = require('autoprefixer');
const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
  devtool: 'eval',

  output: {
    path: path.resolve(__dirname, '../dist'),
    publicPath: "/opsone/opsone-2017/wp-content/themes/opsone-2017-theme/dist/"
  },

  devServer: {
    hot: true,
    port: 3000,
    inline: true,
    host: 'localhost',
    historyApiFallback: true,
    headers: { 'Access-Control-Allow-Origin': '*' },
    compress: true,
    watchOptions: {
      ignored: /node_modules/
    }
  },

  module: {
    rules: [
      {
        test: /\.css$/i,
        use: ['style-loader'].concat([
          { loader: 'css-loader', options: {
            minimize: false,
          }},
          { loader: 'postcss-loader', options: {
            sourceMap: true,
            outputStyle: 'expanded',
            plugins: () => [
              autoprefixer()
            ]
          }},
          'resolve-url-loader',
          { loader: 'sass-loader', options: { sourceMap: true } }
        ])
      },
      {
        test: /\.(ico|jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2)(\?.*)?$/,
        use: [ 'file-loader' ]
      }
    ]
  },

   plugins: [
    new CopyWebpackPlugin([
      {from: 'app/front/files', to: 'files'},
    ]),
    new WriteFilePlugin()
  ]
}
