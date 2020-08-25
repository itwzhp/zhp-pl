<template>
  <component
    :is="_tag"
    v-bind="_to"
    class="z-link"
  >
    <slot />
  </component>
</template>
<script>
  export default {
    name: "ZLink",
    props: {
      tag: {
        type: String,
        default: ""
      },
      to: {
        type: [Object, String],
        default: ()=>({})
      }
    },
    computed: {
      _tag() {
        const tag = this.tag;
        const routerTag = this.routerTag;
        return tag ? tag : routerTag;
      },
      _to() {
        const to = this.to;
        const routerTag = this.routerTag;
        return routerTag === "a" ? {href: to, target: '__blank'} : {to};
      },
      isExternal() {
        const to = this.to;
        return typeof to === "string" && !to.search(/(^\/)/g) > -1;
      },
      routerTag() {
        const isExternal = this.isExternal
        if(this.$nuxt && !isExternal) {
          return "nuxt-link"
        }
        if(this.$router && !isExternal) {
          return "router-link"
        }
        return "a"
      }
    }
  }
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
