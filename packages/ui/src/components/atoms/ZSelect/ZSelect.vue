<template>
  <select
    v-model="v"
    v-outline
    class="z-select"
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
      type: [String, Number, Array],
      default: '',
    },
    options: {
      type: [Array, Object],
      default: () => ({}),
    },
  },
  data() {
    return {
      v: [],
    };
  },
  watch: {
    v() {
      this.$emit('input', this.v);
    },
  },
  mounted() {
    this.v = this.value;
  },
};
</script>
<style lang="scss">
  .z-select {
    overflow: hidden;
    width: var(--select-width, 100%);
    height: var(--select-height, 48px);
    padding: var(--select-padding, 0 16px);
    border: var(--select-border, 1px solid #a6ce39);
    -webkit-appearance: none;
    background: var(--select-background, #fff);
    border-radius: var(--select-border-radius, 10px);
    color: var(--select-color, #1e152f);
    font: inherit;
    font-size: 0.75rem;

    &::placeholder {
      color: var(--select-color, #1e152f);
    }

    &[multiple] {
      --select-height: auto;

      overflow-y: auto;
    }
  }
</style>
