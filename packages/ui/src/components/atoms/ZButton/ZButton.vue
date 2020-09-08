<template>
  <component
    :is="tag"
    v-focus
    class="z-button"
    v-on="$listeners"
  >
    <slot />
  </component>
</template>
<script>
import { focus } from '../../../directives';

export default {
  name: 'ZButton',
  directives: { focus },
  props: {
    tag: {
      type: String,
      default: 'button',
    },
  },
};
</script>
<style lang="scss">
  .z-button {
    display: inline-flex;
    width: var(--button-width);
    min-width: var(--button-min-width);
    height: var(--button-height, 32px);
    align-items: center;
    justify-content: center;
    padding: var(--button-padding);
    border: var(--button-border, 1px solid #7ba22e);
    background: var(--button-background, #a6ce39);
    border-radius: var(--button-border-radius, 10px);
    box-shadow: var(--button-box-shadow);
    color: var(--button-color, #fff);
    text-transform: var(--button-text-transform);

    &--text {
      min-width: var(--button-min-width, unset);
      padding: 0;
      border: 0;
      background: transparent;
      color: var(--button-color, #7ba22e);
    }
  }
</style>
