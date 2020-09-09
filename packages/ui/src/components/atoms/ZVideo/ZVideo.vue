<template>
  <div class="z-video">
    <img
      :src="src"
    >
    <ZButton class="z-video__play">
      <ZIcon name="play" />
    </ZButton>
  </div>
</template>
<script>
import ZButton from '../ZButton/ZButton.vue';
import ZIcon from '../ZIcon/ZIcon.vue';

export default {
  name: 'ZVideo',
  components: { ZButton, ZIcon },
  props: {
    src: {
      type: String,
      default: '',
    },
  },
};
</script>
<style lang="scss">
  .z-video {
    position: relative;

    &::before {
      position: absolute;
      z-index: 1;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to left, #7ba22e 133%, rgba(123, 162, 46, 0) 42%);
      content: "";
      opacity: 0.4;
    }

    &__play {
      position: absolute;
      z-index: 10;
      top: 50%;
      left: 50%;
      transform: translateY(-50%);

      --button-box-shadow: 5px 10px 20px 0 rgba(30, 21, 47, 0.12);
      --button-width: 88px;
      --button-height: 88px;
      --button-background: #fff;
      --icon-color: #78a22f;
      --icon-size: 27px;
      --button-border-radius: 100%;
      --button-border: 0;
    }
  }
</style>
