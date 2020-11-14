<template>
  <div class="z-facebook">
    <div
      class="fb-page"
      data-href="https://www.facebook.com/ZHPpl"
      data-tabs="timeline"
      data-width="260"
      data-height="446"
      data-small-header="false"
      data-adapt-container-width="true"
      data-hide-cover="false"
      data-show-facepile="true"
    />
  </div>
</template>

<script>
export default {
  name: 'ZFacebook',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
  },
};
</script>

<style lang="scss">
.z-facebook {
}
</style>
