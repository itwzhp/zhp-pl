<template>
  <input
    v-focus
    :value="value"
    class="z-input"
    @input="$emit('input', $event.target.value)"
  >
</template>
<script>
import { focus } from '../../../directives';

export default {
  name: 'ZInput',
  directives: {
    focus,
  },
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
    color: var(--input-color, #1e152f);

    &::placeholder {
      color: var(--input-color, #1e152f);
    }
  }
</style>
