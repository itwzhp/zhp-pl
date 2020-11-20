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
  padding: 2rem 0;

  @media (min-width: 480px) {
    padding: 2rem 0;
  }

  & > * {
    position: relative;
    z-index: 1;
  }

  &__question-marks {
    --icon-size: 100px;
    --icon-color: #4a7b26;

    position: absolute;
    top: -2rem;
    opacity: 0.4;

    @media (min-width: 480px) {
      z-index: 0;
      top: 2rem;
      left: 0;
      transform: translate(-66%, -34%);
    }
  }
}
</style>
