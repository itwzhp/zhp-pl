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
    margin: var(--text-margin, 1em 0);
  }
</style>
