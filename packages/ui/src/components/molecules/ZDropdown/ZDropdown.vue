<template>
  <component
    :is="tag"
    class="z-dropdown"
  >
    <slot name="toggle">
      <div class="dropdown__toggle" />
    </slot>
    <slot name="content">
      <div class="dropdown__content">
        <slot />
      </div>
    </slot>
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
