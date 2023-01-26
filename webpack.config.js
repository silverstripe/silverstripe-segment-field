const Path = require('path');
const { JavascriptWebpackConfig, CssWebpackConfig } = require('@silverstripe/webpack-config');

const ENV = process.env.NODE_ENV;
const PATHS = {
  ROOT: Path.resolve(),
  SRC: Path.resolve('client/src'),
  DIST: Path.resolve('client/dist'),
};

const config = [
  // Main JS bundle
  new JavascriptWebpackConfig('js', PATHS, 'silverstripe/segment-field')
    .setEntry({
      'segment-field': `${PATHS.SRC}/bundles/segment-field.js`,
    })
    .getConfig(),
  // sass to css
  new CssWebpackConfig('css', PATHS)
    .setEntry({
      'segment-field': `${PATHS.SRC}/styles/segment-field.scss`,
    })
    .getConfig(),
];

module.exports = config;
