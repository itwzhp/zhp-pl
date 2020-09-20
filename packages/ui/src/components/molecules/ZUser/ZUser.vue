<template>
  <component
    :is="tag"
    class="ComponentNameKebabCase"
  />
</template>

<script>
export default {
  name: 'ComponentNameCamelCase',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
  },
};
</script>

<style lang="scss">
.ComponentNameKebabCase {}
</style>
