<template>
  <div class="z-image">
    <img
      ref="img"
      v-bind="{...$attrs, ...source}"
      alt=""
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
    lazy: {
      type: Boolean,
      default: true,
    },
  },
  computed: {
    source() {
      return this.lazy
        ? { 'data-src': this.src }
        : { src: this.src };
    },
  },
  mounted() {
    if (!this.lazy) return;
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
