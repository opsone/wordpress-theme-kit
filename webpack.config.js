const webpack = require('webpack');
const webpackMerge = require('webpack-merge');
const path = require('path');
const jQuery = require('jquery');

if (typeof Promise === 'undefined') {
  require('promise/lib/rejection-tracking').enable();
  window.Promise = require('promise/lib/es6-extensions.js');
}

const DEVELOPMENT_CONFIG = require('./webpack/webpack.config.dev');
const PRODUCTION_CONFIG  = require('./webpack/webpack.config.prod');

const ENV = process.env.NODE_ENV;
const VALID_ENVIRONMENTS = ['development', 'production'];

if (!VALID_ENVIRONMENTS.includes(ENV)) {
  throw new Error(`${ ENV } is not valid environment!`);
}

const config = {
  development: DEVELOPMENT_CONFIG,
  production:  PRODUCTION_CONFIG
}[ENV];

const COMMON_CONFIG = {
  entry: {
    front: "./app/front/js/index.js",
    admin: "./app/admin"
  },

  output: {
    filename: "[name].js",
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
            ["env", {
              "targets": {
                "chrome": 52,
                "browsers": ["last 2 versions", "safari 7"]
              },
              "modules": false,
              "useBuiltIns": true,
              "debug": ENV === VALID_ENVIRONMENTS[0] ? true : false
            }],
            'stage-2'
          ]
        }
      },
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery"
    }),
  ],
  resolve: {
    extensions: [ '.js' ],
    modules: [
      path.resolve('./app'),
      path.resolve('./node_modules')
    ]
  },

  resolveLoader: {
    modules: [ path.resolve('./node_modules') ]
  }
};

module.exports = webpackMerge.smart(COMMON_CONFIG, config);
