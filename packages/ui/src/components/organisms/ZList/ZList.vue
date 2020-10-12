<template>
  <component
    :is="tag"
    class="z-list"
  >
    <slot />
  </component>
</template>
<script>
export default {
  name: 'ZList',
  props: {
    tag: {
      type: String,
      default: 'ul',
    },
  },
};
</script>
<style lang="scss">
  .z-list {
    padding: 0;
    margin: 0;
    list-style: none;
  }
</style>
