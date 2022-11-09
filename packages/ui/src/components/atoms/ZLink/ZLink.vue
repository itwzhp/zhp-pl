<template>
  <component
    :is="tagComputed"
    v-bind="toComputed"
    class="z-link"
    :class="{'z-link--as-text': tag === 'span'}"
    v-on="$listeners"
  >
    <slot />
  </component>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'ZLink',
  props: {
    tag: {
      type: String,
      default: '',
    },
    to: {
      type: [String, Object],
      default: '',
    },
  },
  computed: {
    ...mapGetters(),
    tagComputed() {
      const { to, tag, routerTag } = this;
      return to
        ? routerTag
        : tag;
    },
    toComputed() {
      const { tagComputed } = this;
      switch (tagComputed) {
        case 'a':
          return { href: this.to, target: '__blank' };
        case 'router-link':
        case 'nuxt-link':
          return { to: this.to };
        default:
          return {};
      }
    },
    isExternal() {
      const { to } = this;
      return typeof to === 'string' && to.search(/(^\/)/g) === -1;
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
  .z-link {
    color: var(--link-color, inherit);
    cursor: pointer;
    font-size: var(--link-font-size, var(--font-size-button));
    font-weight: var(--link-font-weight);
    line-height: 1.2;
    text-decoration: var(--link-text-decoration, inherit);
    transition: var(--link-transition);

    &:hover {
      text-decoration: var(--link-hover-text-decoration, underline);
    }

    &--as-text {
      --link-hover-text-decoration: none;

      cursor: default;
    }
  }
</style>
