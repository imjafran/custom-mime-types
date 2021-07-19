// Generated using webpack-cli https://github.com/webpack/webpack-cli

const path = require('path'); 

const isAdmin = 1

const config = {
  entry: "./src/js/" + (isAdmin ? "admin" : "public") + ".js",
  output: {
    path: path.resolve(__dirname, "public/js/"),
    filename: (isAdmin ? "admin" : "public") + ".js",
  },
  plugins: [
    // Add your plugins here
    // Learn more about plugins from https://webpack.js.org/configuration/plugins/
  ],
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/i,
        loader: "babel-loader",
      },
      {
        test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
        type: "asset",
      },

      // Add your rules for custom modules here
      // Learn more about loaders from https://webpack.js.org/loaders/
    ],
  },
};

module.exports = () => { 
    config.mode = 'development'; 
    return config;
};
