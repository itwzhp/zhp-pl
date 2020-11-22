<template>
  <div
    class="z-video"
    :class="{'is-play': isPlay}"
  >
    <video
      ref="video"
      class="z-video__source"
      muted
    >
      <source
        :src="src"
        type="video/mp4"
      >
      Sorry, your browser doesn't support embedded videos.
    </video>
    <ZButton
      class="z-video__controls"
      :aria-label="aria"
      @click="controls"
    >
      <div
        class="z-video__icon"
      >
        <ZIcon :name="icon" />
      </div>
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
  data() {
    return {
      isPlay: false,
    };
  },
  computed: {
    icon() {
      return this.isPlay
        ? 'pause'
        : 'play';
    },
    aria() {
      return this.isPlay
        ? 'zatrzymaj wideo'
        : 'uruchom wideo';
    },
  },
  methods: {
    controls() {
      if (this.isPlay) {
        this.$refs.video.pause();
      } else {
        this.$refs.video.play();
      }
      this.isPlay = !this.isPlay;
    },
  },
};
</script>
<style lang="scss">
.z-video {
  position: relative;

  &__source {
    width: 100%;
    height: calc(100% + 2.875rem);
    margin: -1.5rem 0;
    object-fit: cover;
  }

  &__controls {
    --button-background: transparent;

    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: opacity 150ms ease-in-out;

    &::before {
      position: absolute;
      width: 100%;
      height: 100%;
      background: #7ba22e;
      content: "";
      opacity: 0.4;
    }

    .is-play & {
      opacity: 0;
    }
  }

  &__icon {
    --icon-color: #78a22f;
    --icon-size: 27px;

    position: absolute;
    top: 50%;
    left: 50%;
    display: inline-flex;
    width: 5.5rem;
    height: 5.5rem;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 50%;
    transform: translateY(-50%);
  }
}
</style>
