<template>
  <component
    :is="tagComputed"
    v-bind="toComputed"
    class="z-link button"
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
      const { routerTag } = this;
      return routerTag === 'a' ? { href: to, target: '__blank' } : { to };
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
    text-decoration: var(--link-text-decoration, inherit);

    &:hover {
      text-decoration: var(--link-text-decoration, underline);
    }
  }
</style>
