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
    name: "ZButton",
    props: {
      tag: {
        type: String,
        default: "button"
      }
    }
  }
</script>
<style lang="scss">
  .z-button {}
</style>
