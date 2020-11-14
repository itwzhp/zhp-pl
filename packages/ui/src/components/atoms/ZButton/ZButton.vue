<template>
  <component
    :is="tag"
    v-outline
    class="z-button"
    v-on="$listeners"
  >
    <slot />
  </component>
</template>
<script>
import { outline } from '../../../directives';

export default {
  name: 'ZButton',
  directives: { outline },
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
    height: var(--button-height, 2rem);
    align-items: center;
    justify-content: center;
    padding: var(--button-padding, 0.5rem 2rem);
    border: var(--button-border, solid #7ba22e);
    border-width: var(--button-border-width, 1px);
    background: var(--button-background, #a6ce39);
    border-radius: var(--button-border-radius, 0.625rem);
    box-shadow: var(--button-box-shadow);
    color: var(--button-color, #fff);
    cursor: var(--button-cursor, pointer);
    font-size: var(--button-font-size, 0.876rem);
    font-weight: 500;
    line-height: 1.2;
    text-transform: var(--button-text-transform, uppercase);

    &--text {
      --button-color: #7ba22e;
      --button-background: transparent;
      --button-min-width: unset;
      --button-text-transform: none;

      padding: 0;
      border: 0;
    }
  }
</style>
