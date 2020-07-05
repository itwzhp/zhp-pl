module.exports = {
  root: true,
  env: {
    jest: true
  },
  extends: [
    "plugin:vue/essential",
    "plugin:vue/strongly-recommended",
    "plugin:vue/recommended"
  ],
  rules: {
    "no-multiple-empty-lines": ["error", { max: 0 }],
  },
  parserOptions: {
    parser: "babel-eslint",
  },
}
