<template>
  <video class="z-video">
    <source
      v-for="(source, key) in sources"
      :key="key"
      :src="source.src"
      :media="source.media"
      :type="source.type"
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
