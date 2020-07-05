<template>
  <component
    :is="`h${level}`"
    class="z-heading"
    :class="`h${level}`"
  >
    <slot />
  </component>
</template>
<script>
  export default {
    name: "ZHeading",
    props: {
      level: {
        type: [String, Number],
        default: "2"
      }
    }
  }
</script>
<style lang="scss">
  $sizes: 2.441rem, 1.953rem, 1.563rem, 1.25rem, 1rem, 0.8rem;
  @each $size in $sizes {
    $i: index($sizes, $size);
    .h#{$i} {
      font-size: $size;
    }
  }
  .z-heading {
    &--uppercase {
      text-transform: uppercase;
    }
  }
</style>
