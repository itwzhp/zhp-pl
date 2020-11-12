<template>
  <component
    :is="tag"
    class="z-list"
  >
    <slot />
  </component>
</template>
<script>
import Vue from 'vue';
import ZListItem from './_internal/ZListItem.vue';

Vue.component('ZListItem', ZListItem);

export default {
  name: 'ZList',
  props: {
    tag: {
      type: String,
      default: 'ul',
    },
  },
};
</script>
<style lang="scss">
  .z-list {
    padding: 0;
    margin: 0;
    list-style: none;
  }
</style>
