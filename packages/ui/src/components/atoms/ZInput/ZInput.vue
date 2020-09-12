<template>
  <input
    :value="value"
    class="z-input"
    @input="$emit($event.target.value)"
  >
</template>
<script>
export default {
  name: 'ZInput',
  model: {
    prop: 'input',
  },
  props: {
    value: {
      type: [String, Number, Boolean],
      default: '',
    },
  },
};
</script>
<style lang="scss">
  .z-input {
    width: var(--input-width, 100%);
    height: var(--input-height, 48px);
    padding: var(--input-padding, 0 16px);
    border: var(--input-border, 1px solid #a6ce39);
    background: var(--input-background);
    border-radius: var(--input-border-radius, 10px);
    color: var(--input-color, #fff);

    &::placeholder {
      color: var(--input-color, #fff);
    }
  }
</style>
