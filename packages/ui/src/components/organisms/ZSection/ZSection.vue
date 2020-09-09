<template>
  <component
    :is="tag"
    class="z-section"
  >
    <slot name="header">
      <div class="z-section__header">
        <slot name="title">
          <ZHeading
            v-if="title"
            class="z-section__title"
            v-text="title"
          />
        </slot>
        <slot name="subtitle">
          <ZText
            v-if="subtitle"
            class="z-section__subtitle"
            v-text="subtitle"
          />
        </slot>
      </div>
    </slot>
    <slot name="content">
      <div class="z-section__content">
        <slot />
      </div>
    </slot>
  </component>
</template>
<script>
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'ZSection',
  components: { ZText, ZHeading },
  props: {
    tag: {
      type: String,
      default: 'section',
    },
    title: {
      type: String,
      default: '',
    },
    subtitle: {
      type: String,
      default: '',
    },
    levelHeading: {
      type: [String, Number],
      default: '2',
    },
  },
};
</script>
<style lang="scss">
  .z-section {
    padding: var(--section-padding);
    margin: var(--section-margin, 90px 0);
    background: var(--section-background);
    color: var(--section-color);

    &__header {
      display: grid;
      max-width: var(--section-header-max-width, 1120px);
      margin: 0 auto 24px auto;
      grid-template-columns: repeat(12, 1fr);
    }

    &__title {
      margin: var(--section--title-margin, 0 0 8px 0);
      font-size: 32px;
      font-weight: 900;
      grid-column: span 4;
      text-transform: uppercase;
    }

    &__subtitle {
      margin: var(--section--subtitle-margin);
      font-size: 16px;
      grid-column: span 5;
      grid-row: 2;
    }

    &__content {
      display: grid;
      max-width: var(--section-content-max-width, 1120px);
      align-items: var(--section-content-align-items);
      margin: var(--section-content-margin, auto);
      grid-gap: 20px;
      grid-template-columns: var(--section-content-grid-template-columns, repeat(12, 1fr));
    }
  }
</style>
