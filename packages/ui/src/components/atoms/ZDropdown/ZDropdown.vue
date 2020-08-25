<template>
  <component
    :is="tag"
    class="z-dropdown"
  >
    <slot />
  </component>
</template>
<script>
export default {
  name: 'ZDropdown',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
  },
};
</script>
<style lang="scss">
  .z-dropdown {}
</style>
