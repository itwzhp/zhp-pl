<template>
  <component
    :is="tag"
    class="z-section"
  >
    <slot name="header">
      <div
        v-if="hasHeader"
        class="z-section__header"
      >
        <slot name="title">
          <ZHeading
            v-if="title"
            v-bind="headingProps"
            class="z-section__title t4 uppercase"
          >{{title}}</ZHeading>
        </slot>
        <slot name="subtitle">
          <ZText
            v-if="subtitle"
            class="z-section__subtitle subtitle-1"
          >{{subtitle}}</ZText>
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
    headingProps: {
      type: Object,
      default: () => ({}),
    },
  },
  computed: {
    hasHeader() {
      return true;
    },
  },
};
</script>

<style lang="scss">
  .z-section {
    --section-max-width: 1140px;
    --section-padding: 0 1.25rem;
    --section-grid-template-columns: repeat(12, minmax(auto, 1fr));

    padding: var(--section-padding);
    margin: var(--section-margin, 2.25rem 0);
    background: var(--section-background);

    @media (min-width: 480px) {
      --section-margin: 5.5rem 0;
    }

    &__header {
      display: grid;
      max-width: var(--section-header-max-width, var(--section-max-width));
      padding: var(--section-header-padding, var(--section-padding));
      margin: var(--section-header-margin, 0 auto 1.5rem auto);
      grid-template-columns: var(--section-header-grid-template-columns, var(--section-grid-template-columns));

      &:empty {
        --section-header-margin: 0;
      }
    }

    &__title {
      margin: var(--section-title-margin, 0 0 0.75rem 0);
      grid-column: var(--section-title-grid-column, span 12);
      grid-row: var(--section-title-grid-row, 1);

      @media (min-width: 480px) {
        --section-title-grid-column: span 4;
      }
    }

    &__subtitle {
      grid-column: var(--section-subtitle-grid-column, span 12);
      grid-row: var(--section-subtitle-grid-row, 2);

      @media (min-width: 480px) {
        --section-subtitle-grid-column: span 5;
      }
    }

    &__content {
      display: grid;
      max-width: var(--section-content-max-width, var(--section-max-width));
      height: var(--section-content-height);
      align-items: var(--section-content-align-items);
      padding: var(--section-content-padding, var(--section-padding));
      margin: var(--section-content-margin, auto);
      gap: 1.25rem;
      grid-template-columns: var(--section-content-grid-template-columns, var(--section-grid-template-columns));
    }
  }
</style>
