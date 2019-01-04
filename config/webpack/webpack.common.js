const path = require('path')
const webpack = require('webpack')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const ManifestPlugin = require('webpack-manifest-plugin')
const WebpackBar = require('webpackbar')

module.exports = {
  entry: {
    front: "./assets/front/js/index.js",
    admin: "./assets/admin"
  },
  plugins: [
    new CleanWebpackPlugin(['../assets/dist']),
    new ManifestPlugin(),
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery"
    }),
    new WebpackBar()
  ],
  output: {
    path: path.resolve(__dirname, '../assets/dist'),
    filename: "[name].js",
  },
  node: { fs: 'empty' },
  externals: ['jQuery'],
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: ['file-loader'],
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        use: ['file-loader'],
      },
      {
        test: /\.(csv|tsv)$/,
        use: ['csv-loader'],
      },
      {
        test: /\.xml$/,
        use: ['xml-loader'],
      },
    ],
  },
  resolve: {
    extensions: [ '.js' ],
    modules: [
      path.resolve('./assets'),
      path.resolve('./node_modules')
    ]
  },
}
