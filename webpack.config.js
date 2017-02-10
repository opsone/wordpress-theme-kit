var webpack                 = require('webpack');
var autoprefixer            = require('autoprefixer');
var precss                  = require('precss');
var path                    = require('path');
var ExtractTextPlugin       = require("extract-text-webpack-plugin");
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
var CopyWebpackPlugin       = require('copy-webpack-plugin');
var ImageminWebpackPlugin   = require('imagemin-webpack-plugin').default;
var ImageminMozjpeg         = require('imagemin-mozjpeg');

if (typeof Promise === 'undefined') {
  // Rejection tracking prevents a common issue where React gets into an
  // inconsistent state due to an error, but it gets swallowed by a Promise,
  // and the user has no idea what causes React's erratic future behavior.
  require('promise/lib/rejection-tracking').enable();
  window.Promise = require('promise/lib/es6-extensions.js');
}

module.exports = {
  devtool: 'eval',
  // devtool: 'sourcemap',

  entry: {
		front: "./app/front/js/index.js",
		admin: "./app/admin"
	},
	output: {
		path: './dist',
		filename: "[name].js",
    // pathinfo: true, // TODO En dev
	},

  module: {
    rules: [
      {
        test: /\.jsx?$/,
        include: './app',
        enforce: 'pre',
        use: [
          {
            loader: 'eslint-loader',
            options: {rules: {semi: 0}}
          }
        ]
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
      // {// A) Internal CSS
      //   test: /\.css$/,
      //   loader: 'style-loader!css-loader!postcss-loader'
      // },
      {// B) external CSS
        test: /\.css$/,
        loader: ExtractTextPlugin.extract({
            fallbackLoader: 'style-loader',
            loader: [ 'css-loader', 'postcss-loader' ]
        })
      },
      // {
      //   test: /\.(ico|jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2)(\?.*)?$/,
      //   use: [ 'file-loader' ]
      // }
      {// for image in css file
        test: /.*\.(gif|png|jpe?g|svg)$/i,
        loaders: [
          'file-loader',
          {
            loader: 'image-webpack-loader',
            query: {
              progressive: true,
              mozjpeg: {
                quality: 80
              }
            }
          }
        ]
      }
    ]
  },

   plugins: [
    new webpack.LoaderOptionsPlugin({
      // test: /\.xxx$/, // may apply this only for some modules
      options: {
        postcss: function() {
          return [
            autoprefixer({
              browsers: [
                '>1%',
                'last 4 versions',
                'Firefox ESR',
                'not ie < 9', // React doesn't support IE8 anyway
              ]
            }),
            precss()
          ];
        }
      }
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
      test: 'images/**',
      plugins: [
        ImageminMozjpeg({
          quality: 80,
          progressive: true
        })
      ]
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
