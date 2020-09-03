<template>
  <component
    :is="tag"
    class="z-bubble"
  >
    <ZButton
      v-if="hasButton"
      class="z-bubble__button"
    >
      <ZIcon name="cross" />
    </ZButton>
    <slot />
  </component>
</template>

<script>
import ZButton from '../ZButton/ZButton.vue';
import ZIcon from '../ZIcon/ZIcon.vue';

export default {
  name: 'ZBubble',
  components: {
    ZButton,
    ZIcon,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    type: {
      type: String,
      default: 'label',
    },
  },
  computed: {
    hasButton() {
      return this.type === 'filter';
    },
  },
};
</script>

<style lang="scss">
  .z-bubble {
    display: grid;
    min-width: var(--bubble-min-width, 72px);
    height: var(--bubble-height, 20px);
    align-items: center;
    justify-content: center;
    padding: var(--bubble-padding, 0 4px);
    background: var(--bubble-background, #78a22f);
    border-radius: var(--bubble-border-radius, 10px);
    color: var(--bubble-color, #fff);
    column-gap: 4px;
    font-size: var(--bubble-font-size, 10px);
    grid-auto-flow: column;

    &__button {
      --icon-size: 4px;
      --icon-color: #fff;
      --button-width: 14px;
      --button-min-width: 14px;
      --button-height: 14px;
      --button-border-radius: 14px;
      --button-border: 0;
    }
  }
</style>
