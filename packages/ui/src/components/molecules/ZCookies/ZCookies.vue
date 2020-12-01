<template>
  <component
    :is="tag"
    class="z-cookies"
  >
    <div class="z-cookies__container">
      <ZText
        tag="span"
        class="z-cookies__description button light"
      >
        Ta strona używa ciasteczek (cookies), dzięki którym nasz serwis może działać lepiej.
      </ZText>
      <ZButton @click="$emit('close')">
        Rozumiem
      </ZButton>
    </div>
  </component>
</template>

<script>
import ZText from '../../atoms/ZText/ZText.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';

export default {
  name: 'ZCookies',
  components: {
    ZButton,
    ZText,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
  },
};
</script>

<style lang="scss">
.z-cookies {
  width: 100%;
  background: #fff;
  box-shadow: 5px 10px 20px 0 rgba(30, 21, 47, 0.12);

  &__container {
    --button-text-transform: none;

    display: grid;
    max-width: 1140px;
    align-items: center;
    align-items: center;
    justify-content: center;
    padding: 1rem 1.25rem;
    margin: auto;
    gap: 1rem;
    grid-auto-flow: column;
  }

  &__description {
    @media (max-width: 640px) {
      font-size: 0.75rem;
    }
  }
}
</style>
