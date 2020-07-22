# WP Theme Boilerplate using Webpack

## Build Setup

``` bash
# install dependencies
npm install

# change proxy location for browsersync in webpack.config.js file
# on line 38, change proxy: "localhost/site-path"
# CHANGE LINE BELOW
proxy: 'localhost/merlin-2017', 

# build public files
npm run build

# watch files with BrowserSync
npm run watch
