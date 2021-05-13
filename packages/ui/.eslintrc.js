module.exports = {
  root: true,
  env: {
    jest: true,
  },
  extends: [
    'plugin:vue/recommended',
  ],
  rules: {
    'no-multiple-empty-lines': ['error', { max: 1 }],
    'max-len': ['error', {
      code: 120, ignoreStrings: true, ignoreUrls: true, ignorePattern: '<path|d=',
    }],
  },
  parserOptions: {
    parser: 'babel-eslint',
  },
  ignorePatterns: ['**/directives/*'],
};
