<template>
  <component
    :is="tag"
    class="z-did-you-know"
  >
    <ZIcon
      name="question-marks"
      class="z-did-you-know__question-marks"
    />
    <ZText
      tag="div"
      class="z-did-you-know__title caption uppercase black"
    >
      Czy wiesz że...
    </ZText>
    <ZText class="caption">
      {{ randomText }}
    </ZText>
  </component>
</template>

<script>
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'ZDidYouKnow',
  components: {
    ZIcon,
    ZText,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    randomText: {
      type: String,
      default: 'div',
    },
  },
};
</script>

<style lang="scss">
.z-did-you-know {
  position: relative;

  & > * {
    position: relative;
    z-index: 1;
  }

  &__question-marks {
    --icon-size: 100px;

    position: absolute;
    z-index: 0;
    top: 0;
    left: 0;
    fill: #4a7b26;
    opacity: 0.4;
    transform: translate(-66%, -34%);
  }
}
</style>
