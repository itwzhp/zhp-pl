<template>
  <component
    :is="tag"
    class="z-accordion"
  >
    <slot />
  </component>
</template>

<script>
import Vue from 'vue';
import ZAccordionItem from './_internal/ZAccordionItem.vue';

Vue.component('ZAccordionItem', ZAccordionItem);
export default {
  name: 'ZAccordion',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    multiple: {
      type: Boolean,
      default: false,
    },
  },
  provide() {
    const accordion = {};
    Object.defineProperty(accordion, 'opened', {
      enumerable: true,
      get: () => this.opened,
    });
    Object.defineProperty(accordion, 'open', {
      value: this.open,
    });
    return { accordion };
  },
  data() {
    return {
      opened: this.multiple ? [] : '',
    };
  },
  methods: {
    open(payload) {
      this.opened = payload;
    },
  },
};
</script>

<style lang="scss">
.z-accordion {}
</style>
