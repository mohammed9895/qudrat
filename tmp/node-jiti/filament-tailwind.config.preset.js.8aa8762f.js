"use strict";Object.defineProperty(exports, "__esModule", {value: true}); function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }var _tailwindconfigpresetjs = require('../support/tailwind.config.preset.js'); var _tailwindconfigpresetjs2 = _interopRequireDefault(_tailwindconfigpresetjs);
var _defaultTheme = require('tailwindcss/defaultTheme'); var _defaultTheme2 = _interopRequireDefault(_defaultTheme);

_tailwindconfigpresetjs2.default.theme.extend.fontFamily = {
    sans: ['var(--font-family)', ..._defaultTheme2.default.fontFamily.sans],
}

exports. default = _tailwindconfigpresetjs2.default
 /* v7-c3a221be9b5d2dd9 */