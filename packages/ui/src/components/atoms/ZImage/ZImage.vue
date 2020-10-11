<template>
  <div class="z-image">
    <img
      ref="img"
      :data-src="src"
      v-bind="$attrs"
    >
  </div>
</template>
<script>
import lozad from 'lozad';

export default {
  name: 'ZImage',
  inheritAttrs: false,
  props: {
    src: {
      type: String,
      default: '',
    },
  },
  mounted() {
    const { img } = this.$refs;
    const observer = lozad(img);
    observer.observe();
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
  }
</style>
