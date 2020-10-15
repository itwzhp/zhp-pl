<template>
  <div
    class="glide"
    :class="{'z-carousel--peeked': peeked}"
  >
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
import lozad from 'lozad';

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
  data() {
    return {
      default: {
        type: 'carousel',
        perView: 4,
        gap: 20,
      },
    };
  },
  computed: {
    options() {
      return {
        ...this.default,
        ...this.settings,
      };
    },
  },
  mounted() {
    this.$nextTick(() => {
      // eslint-disable-next-line no-shadow
      const ClonesTabindex = (Glide, Components, Events) => ({
        mount() {
          this.setTabindex();
          Events.on('run', () => {
            this.setTabindex();
          });
        },
        setTabindex() {
          Components.Clones.items.forEach((clone) => {
            clone.querySelectorAll('a')
              .forEach((anchor) => { anchor.setAttribute('tabindex', '-1'); });
            clone.querySelectorAll('img')
              .forEach((img) => {
                const observer = lozad(img);
                observer.observe();
              });
          });
        },
      });
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
      let extensions = { ClonesTabindex };
      if (this.peeked) {
        extensions = { ...extensions, VisibleClass };
      }
      new Glide(this.$el, this.options).mount(extensions);
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
          padding: 24px 0;
          grid-auto-flow: column;
        }

        &__slide {
          display: grid;
          opacity: 0.4;
          transition: opacity 200ms ease-in-out;

          &--visible {
            opacity: 1;

            & > * {
              transition: transform  300ms ease-in-out;

              &:hover {
                transform: scale(1.08);
                transform-origin: center;
              }
            }
          }
        }
      }
    }
  }
</style>
