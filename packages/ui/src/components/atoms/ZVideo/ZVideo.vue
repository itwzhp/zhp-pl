<template>
  <div class="z-video">
    <iframe
      width="560"
      height="315"
      :src="`https://www.youtube-nocookie.com/embed/${yt}?controls=0`"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
      allowfullscreen
      class="z-video__iframe"
    />
  </div>
</template>

<script>
export default {
  name: 'ZVideo',
  props: {
    yt: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="scss">
  .z-video {
    position: relative;
    height: 0;
    padding-bottom: 56.25%; // 16:9

    &__iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  }
</style>
