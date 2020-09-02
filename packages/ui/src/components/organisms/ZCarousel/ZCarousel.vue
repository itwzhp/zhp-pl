<template>
  <div class="glide">
    <div
      class="glide__track"
      data-glide-el="track"
    >
      <ul class="glide__slides">
        <slot />
      </ul>
    </div>
  </div>
</template>
<script>
import Glide from '@glidejs/glide';

export default {
  name: 'ZCarousel',
  props: {
    settings: {
      type: Object,
      default: () => ({
        type: 'carousel',
        perView: 4,
        gap: 20,
      }),
    },
  },
  mounted() {
    const { settings } = this;
    this.$nextTick(() => {
      new Glide(this.$el, settings).mount();
    });
  },
};
</script>
<style lang="scss">
  @import "~@glidejs/glide/src/assets/sass/glide.core";
  .z-carousel {}
</style>
