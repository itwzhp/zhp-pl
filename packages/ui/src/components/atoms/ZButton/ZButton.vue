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
    align-items: center;
    justify-content: center;
    border: 1px solid #7ba22e;
    background: var(--button-background, #a6ce39);
    border-radius: 6px;
    color: var(--button-color, #fffff);

    &--text {
      padding: 0;
      border: 0;
      background: transparent;
    }
  }
</style>
