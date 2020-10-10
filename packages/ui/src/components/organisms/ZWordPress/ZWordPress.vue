<template>
  <component
    :is="tag"
    class="z-word-press"
    v-html="html"
  />
</template>

<script>
export default {
  name: 'ZWordPress',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    html: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="scss">
.z-word-press {
  line-height: 1.4;

  p {
    margin: 1rem 0;
  }
}
</style>
