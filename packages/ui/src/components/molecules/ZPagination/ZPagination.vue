<template>
  <component :is="tag" class="z-pagination"></component>
</template>

<script>
  export default {
    name: "ZPagination",
    props: {
      tag: {
        type: String,
        default: 'div'
      }
    }
  }
</script>

<style lang="scss">
  .z-pagination {}
</style>
