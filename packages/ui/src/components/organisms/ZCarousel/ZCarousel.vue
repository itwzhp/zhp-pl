<template>
  <div
    class="glide z-carousel"
    :class="{'z-carousel--peeked': peeked}"
  >
    <div
      v-if="hasControls"
      class="z-carousel__controls"
    >
      <ZButton
        aria-label="poprzedni"
        @click="glide.go('<')"
      >
        <ZIcon name="arrow-left" />
      </ZButton>
      <ZButton
        aria-label="następny"
        @click="glide.go('>')"
      >
        <ZIcon name="arrow-right" />
      </ZButton>
    </div>
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
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';

export default {
  name: 'ZCarousel',
  components: {
    ZIcon,
    ZButton,
  },
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
    hasControls: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      default: {
        type: 'carousel',
        perView: 4,
        gap: 20,
        glide: null,
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
      const glide = new Glide(this.$el, this.options).mount(extensions);
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        glide.update({ autoplay: false });
      }
      this.glide = glide;
    });
  },
};
</script>

<style lang="scss">
  @import "~@glidejs/glide/src/assets/sass/glide.core";

  .z-carousel {
    &__controls {
      --icon-color: #fff;
      --button-min-width: none;
      --button-width: 34px;
      --button-height: 34px;
      --button-padding: 0;

      display: grid;
      justify-content: end;
      gap: 8px;
      grid-auto-flow: column;
    }

    &--peeked {
      .glide {
        &__track {
          overflow: visible;
        }

        &__slides {
          display: grid;
          align-items: center;
          padding: var(--carousel-slides-padding, 24px 0);
          grid-auto-flow: column;
        }

        &__slide {
          display: grid;
          opacity: 0.4;
          transition: opacity 200ms ease-in-out;

          &--visible {
            opacity: 1;

            & > * {
              @media (min-width: 640px) and (prefers-reduced-motion: no-preference) {
                transition: transform 300ms ease-in-out;
              }

              &:hover {
                @media (min-width: 640px) and (prefers-reduced-motion: no-preference) {
                  transform: scale(1.08);
                  transform-origin: center;
                }
              }
            }
          }
        }
      }
    }

    .glide {
      &__slides {
        align-items: center;
      }
    }
  }
</style>
