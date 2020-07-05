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
  .z-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 0;
    &--pure {
      padding: 0;
      background: transparent;
    }
  }
</style>
