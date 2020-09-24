<template>
  <select
    v-outline
    class="z-select"
    @input="$emit('input', $event.target.value)"
  >
    <slot name="options">
      <option
        v-for="(option, key) in options"
        :key="key"
        :value="option.value"
        :selected="value === option.value"
      >
        {{ option.label }}
      </option>
    </slot>
  </select>
</template>
<script>
import { outline } from '../../../directives';

export default {
  name: 'ZSelect',
  directives: {
    outline,
  },
  props: {
    value: {
      type: String,
      default: '',
    },
    options: {
      type: Array,
      default: () => ({}),
    },
  },
};
</script>
<style lang="scss">
  .z-select {
    width: var(--select-width, 100%);
    height: var(--select-height, 48px);
    padding: var(--select-padding, 0 16px);
    border: var(--select-border, 1px solid #a6ce39);
    background: var(--select-background, #fff);
    border-radius: var(--select-border-radius, 10px);
    color: var(--select-color, #1e152f);

    &::placeholder {
      color: var(--select-color, #1e152f);
    }
  }
</style>
