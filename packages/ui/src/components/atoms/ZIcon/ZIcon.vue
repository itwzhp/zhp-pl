<template>
  <svg
    :viewBox="viewBox"
    class="z-icon"
  >
    <slot>
      <path
        v-for="(path, key) in paths"
        :key="key"
        :d="path"
      />
    </slot>
  </svg>
</template>
<script>
  import {icons} from "./icons"
  export default {
    name: "ZIcon",
    props: {
      name: {
        type: String,
        default: ""
      }
    },
    computed: {
      paths() {
        const iconName = this.name;
        return icons[iconName] ? icons[iconName].paths : [];
      },
      viewBox() {
        const iconName = this.icon;
        return icons[iconName] ? icons[iconName].viewBox : "0 0 24 24"
      }
    }
  }
</script>
<style lang="scss">
  .z-icon {
    width: var(--icon-size, 1rem);
    height: var(--icon-size, 1rem);
    fill: var(--icon-color);
  }
</style>
