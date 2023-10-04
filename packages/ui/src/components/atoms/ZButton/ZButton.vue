<template>
  <component
    :is="tagComputed"
    v-bind="toComputed"
    class="z-button"
    v-on="$listeners"
  >
    <slot />
  </component>
</template>
<script>
import { outline } from '../../../directives';

export default {
  name: 'ZButton',
  directives: { outline },
  props: {
    tag: {
      type: String,
      default: 'button',
    },
    to: {
      type: [String, Object],
      default: '',
    },
  },
  computed: {
    hack() {
      return typeof this.to === 'string'
        ? this.to.replace(/https?:\/\/prod\.przemyslawspaczek\.pl|https?:\/\/zhp\.pl/gm, '')
        : this.to;
    },
    tagComputed() {
      const { to, tag, routerTag } = this;
      return to
        ? routerTag
        : tag;
    },
    toComputed() {
      const { hack, tagComputed } = this;
      switch (tagComputed) {
        case 'a':
          return { href: hack, target: '_blank' };
        case 'router-link':
        case 'nuxt-link':
          return { to: hack };
        default:
          return {};
      }
    },
    isExternal() {
      const { hack } = this;
      return typeof hack === 'string' && hack.search(/(^\/)/g) === -1;
    },
    routerTag() {
      const { isExternal } = this;
      if (this.$nuxt && !isExternal) {
        return 'nuxt-link';
      }
      if (this.$router && !isExternal) {
        return 'router-link';
      }
      return 'a';
    },
  },
};
</script>
<style lang="scss">
  .z-button {
    display: var(--button-display, inline-flex);
    width: var(--button-width);
    min-width: var(--button-min-width);
    height: var(--button-height, 2rem);
    align-items: center;
    justify-content: var(--button-justify-content, center);
    padding: var(--button-padding, 0.5rem 2rem);
    border: var(--button-border);
    border-width: var(--button-border-width, 0);
    background: var(--button-background, #a6ce39);
    border-radius: var(--button-border-radius, 0.625rem);
    box-shadow: var(--button-box-shadow);
    color: var(--button-color, #fff);
    cursor: var(--button-cursor, pointer);
    font-family: inherit;
    font-size: var(--button-font-size, 0.876rem);
    font-weight: 500;
    line-height: 1.2;
    text-align: var(--button-text-align);
    text-decoration: var(--button-text-decoration, none);
    text-transform: var(--button-text-transform, uppercase);

    &--text {
      --button-color: var(--button-text-color, var(--color-primary-darken));
      --button-background: transparent;
      --button-min-width: unset;
      --button-text-transform: none;

      padding: 0;
      border: 0;
    }

    &--full {
      --button-width: 100%;
    }
  }
</style>
