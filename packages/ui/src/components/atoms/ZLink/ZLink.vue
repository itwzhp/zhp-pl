<template>
  <component
    :is="tagComputed"
    v-bind="toComputed"
    class="z-link"
    v-on="$listeners"
  >
    <slot />
  </component>
</template>

<script>
export default {
  name: 'ZLink',
  props: {
    tag: {
      type: String,
      default: '',
    },
    to: {
      type: [Object, String],
      default: () => ({}),
    },
  },
  computed: {
    tagComputed() {
      const { tag } = this;
      const { routerTag } = this;
      return tag || routerTag;
    },
    toComputed() {
      const { to } = this;
      const { tagComputed } = this;
      switch (tagComputed) {
        case 'a':
          return { href: to, target: '__blank' };
        case 'router-link':
        case 'nuxt-link':
          return { to };
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

    &:hover {
      text-decoration: var(--link-text-decoration, underline);
    }
  }
</style>
