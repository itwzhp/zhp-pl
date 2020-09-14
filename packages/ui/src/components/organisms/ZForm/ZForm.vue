<template>
  <component :is="tag" class="z-form"></component>
</template>

<script>
  export default {
    name: "ZForm",
    props: {
      tag: {
        type: String,
        default: 'div'
      }
    }
  }
</script>

<style lang="scss">
  .z-form {}
</style>
