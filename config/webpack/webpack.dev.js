const merge = require('webpack-merge')
const common = require('./webpack.common.js')

require('../../scripts/watch.assets.js')

module.exports = merge(common, {
  mode: 'development',
  devtool: 'eval',
  output: {
    publicPath: 'http://localhost:3000/'
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
        test: /\.js$/,
        exclude: /node_modules/,
        enforce: 'pre',
        loader: 'eslint-loader',
      },
      {
        test: /\.scss$/,
        use: [
          'style-loader',
          'css-loader',
          'sass-loader',
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: [require('autoprefixer')()],
            },
          },
        ],
      },
    ],
  },
})
