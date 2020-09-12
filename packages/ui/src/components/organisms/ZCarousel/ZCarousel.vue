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
    peeked: {
      type: Boolean,
      default: false,
    },
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
      // eslint-disable-next-line no-shadow
      const VisibleClass = (Glide, Components, Events) => ({
        mount() {
          this.setVisibleClass('=');
          // fixme: index on the edge
          Events.on('run', () => {
            this.setVisibleClass();
          });
        },
        setVisibleClass() {
          const className = 'glide__slide--visible';
          const { root, slides } = Components.Html;
          const { perView } = Glide.settings;
          root.querySelectorAll(`.${className}`)
            .forEach((slide) => { slide.classList.remove(className); });
          let common = slides[Glide.index];
          for (let i = 0; i < perView; i += 1) {
            if (common) {
              common.classList.add(className);
              common = common.nextElementSibling;
            }
          }
        },
      });
      let extensions = {};
      if (this.peeked) {
        extensions = { ...extensions, VisibleClass };
      }
      new Glide(this.$el, settings).mount(extensions);
    });
  },
};
</script>
<style lang="scss">
  @import "~@glidejs/glide/src/assets/sass/glide.core";

  .z-carousel {
    &--peeked {
      .glide {
        &__track {
          overflow: visible;
        }

        &__slides {
          display: grid;
          padding: 0 0 6px 0;
          grid-auto-flow: column;
        }

        &__slide {
          display: grid;
          opacity: 0.4;
          transition: opacity 200ms ease-in-out;

          &--visible {
            opacity: 1;
          }
        }
      }
    }
  }
</style>
