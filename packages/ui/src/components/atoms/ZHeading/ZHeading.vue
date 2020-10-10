<template>
  <component
    :is="`h${level}`"
    class="z-heading"
  >
    <slot />
  </component>
</template>
<script>
export default {
  name: 'ZHeading',
  props: {
    level: {
      type: [String, Number],
      default: '2',
    },
  },
};
</script>
<style lang="scss">
  .z-heading {}
</style>
