<template>
  <div class="z-image">
    <img
      :src="src"
      v-bind="$attrs"
    >
  </div>
</template>
<script>
export default {
  name: 'ZImage',
  inheritAttrs: false,
  props: {
    src: {
      type: String,
      default: '',
    },
  },
};
</script>
<style lang="scss">
  .z-image {
    display: flex;
    align-items: center;
    justify-content: center;

    img {
      width: var(--image-width);
      max-width: 100%;
      height: var(--image-height, auto);
    }

    &--has-overlay {
      background: var(--color-primary);
      opacity: 0.4;
    }
  }
</style>
