<template>
  <picture
    ref="image"
    class="z-image"
    :data-iesrc="src"
    :data-alt="alt"
  >
    <source
      v-for="(source, key) in sources"
      :key="key"
      :srcset="source.srcset"
      :media="source.media"
      :type="source.type"
    >
  </picture>
</template>
<script>
  import lozad from "lozad";
  export default {
    name: "ZImage",
    props: {
      src: {
        type: String,
        default: ""
      },
      sources: {
        type: Array,
        default: ()=>([])
      },
      alt: {
        type: String,
        default: ""
      },
      lazy: {
        type: Boolean,
        default: true
      },
      rootMargin: {
        type: String,
        default: '0px'
      },
      threshold: {
        type: Number,
        default: 0
      }
    },
    mounted() {
      const lazy = this.lazy;
      const rootMargin = this.rootMargin;
      const threshold = this.threshold;
      const {image} = this.$refs;
      const observer = lozad(image, {
        rootMargin,
        threshold
      })
      observer.observe();
    }
  }
</script>
<style lang="scss">
  .z-image {
    img {
      width: var(--image-width);
      max-width: 100%;
      height: var(--image-height, auto);
    }
  }
</style>
