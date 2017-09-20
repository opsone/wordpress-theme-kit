var webpack                 = require('webpack');
var autoprefixer            = require('autoprefixer');
var path                    = require('path');
var ExtractTextPlugin       = require("extract-text-webpack-plugin");
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
var CopyWebpackPlugin       = require('copy-webpack-plugin');
var ImageminWebpackPlugin   = require('imagemin-webpack-plugin').default;
var CompressionPlugin       = require("compression-webpack-plugin");
var ImageminPngquant        = require('imagemin-pngquant');
var ImageminJpegoptim       = require('imagemin-jpegoptim');
var ImageminSvgo            = require('imagemin-svgo');
var jQuery                  = require('jquery');

if (typeof Promise === 'undefined') {
  // Rejection tracking prevents a common issue where React gets into an
  // inconsistent state due to an error, but it gets swallowed by a Promise,
  // and the user has no idea what causes React's erratic future behavior.
  require('promise/lib/rejection-tracking').enable();
  window.Promise = require('promise/lib/es6-extensions.js');
}

module.exports = {
  // devtool: 'eval',
  devtool: 'sourcemap',

  entry: {
		front: "./app/front/js/index.js",
		admin: "./app/admin"
	},
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: "[name].js",
    // pathinfo: true, // TODO En dev
	},

  externals: ['jQuery'],

  module: {
    rules: [
      {
        test: /\.jsx?$/,
        include: path.resolve(__dirname, 'app'),
        enforce: 'pre',
        loader: 'eslint-loader',
      },
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
        options: {
          presets: [
            [ 'latest', { 'es2015': { 'modules': false } } ],
            'stage-2'
          ]
        }
      },
      {
        test: /\.css$/,
        loader: ExtractTextPlugin.extract({
            fallback: 'style-loader',
            use: [
              { loader: 'css-loader', options: { importLoaders: 1, sourceMap: true } },
              { loader: 'postcss-loader', options: {
                ident: 'postcss',
                sourceMap: true,
                plugins: () => [
                  require('postcss-flexbugs-fixes'),
                  autoprefixer({
                    browsers: [
                      '>1%',
                      'last 4 versions',
                      'Firefox ESR',
                      'not ie < 9', // React doesn't support IE8 anyway
                    ],
                    flexbox: 'no-2009',
                  })
                ]
              }},
              { loader: 'sass-loader', options: { sourceMap: true } }
            ]
        })
      },
      {
        test: /\.(ico|jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2)(\?.*)?$/,
        use: [ 'file-loader' ]
      }
    ]
  },

   plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery"
    }),
    new webpack.optimize.UglifyJsPlugin(),
    new ExtractTextPlugin("style.css"), // FOR B)
    new OptimizeCssAssetsPlugin({
      assetNameRegExp: /\.css$/,
      cssProcessorOptions: { discardComments: { removeAll: true } }
    }),
    // for image use in website
    new CopyWebpackPlugin([
        {from: 'app/front/images', to: 'images', force: true},
    ]),
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
  ],

  resolve: {
    extensions: [ '.js', ],
    modules: [
      path.resolve('./app'),
      path.resolve('./node_modules')
    ]
  },

  resolveLoader: {
    modules: [ path.resolve('./node_modules') ]
  }
}
