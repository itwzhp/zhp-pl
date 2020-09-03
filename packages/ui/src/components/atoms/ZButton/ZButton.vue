<template>
  <component
    :is="tag"
    class="z-button"
    v-on="$listeners"
  >
    <slot />
  </component>
</template>
<script>
export default {
  name: 'ZButton',
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
    min-width: var(--button-min-width, 168px);
    height: var(--button-height, 32px);
    align-items: center;
    justify-content: center;
    padding: var(--button-padding);
    border: var(--button-border, 1px solid #7ba22e);
    background: var(--button-background, #a6ce39);
    border-radius: var(--button-border-radius, 6px);
    color: var(--button-color, #fff);
    text-transform: var(--button-text-transform);

    &--text {
      min-width: var(--button-min-width, unset);
      padding: 0;
      border: 0;
      background: transparent;
    }
  }
</style>
