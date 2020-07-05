<template>
  <video class="z-video">
    <source
      v-for="({src, media, type}, key) in sources"
      :key="key"
      :src="src"
      :media="media"
      :type="type"
    >
  </video>
</template>
<script>
  export default {
    name: "ZVideo",
    props: {
      sources: {
        type: Array,
        default: ()=>([])
      },
    }
  }
</script>
<style lang="scss">
  .z-video {}
</style>
