<template>
  <component
    :is="tag"
    class="z-text"
  >
    <slot />
  </component>
</template>
<script>
export default {
  name: 'ZText',
  props: {
    tag: {
      type: String,
      default: 'p',
    },
  },
};
</script>
<style lang="scss">
  .z-text {
    font-size: var(--text-font-size);
  }
</style>
