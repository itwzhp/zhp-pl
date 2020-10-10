module.exports = {
  extends: [
    'stylelint-config-standard',
    'stylelint-scss',
    'stylelint-config-idiomatic-order',
  ],
  rules: {
    'selector-max-id': 1,
    'at-rule-no-unknown': [true, {
      ignoreAtRules: ['function', 'if', 'each', 'include', 'mixin', 'for'],
    }],
    'order/order': [
      'custom-properties',
      'declaration',
    ],
  },
};
