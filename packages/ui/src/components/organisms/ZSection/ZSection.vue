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
            v-html="title"
          />
        </slot>
        <slot name="subtitle">
          <ZText
            v-if="subtitle"
            class="z-section__subtitle subtitle-1"
            v-html="subtitle"
          />
        </slot>
        <slot name="more">
          <ZLink
            v-if="more"
            :to="more"
            class="z-section__more"
          >
            Zobacz więcej
          </ZLink>
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
import ZLink from '../../atoms/ZLink/ZLink.vue';

export default {
  name: 'ZSection',
  components: { ZText, ZHeading, ZLink },
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
    more: {
      type: [Object, String],
      default: '',
    },
  },
  computed: {
    hasHeader() {
      return this.title || this.subtitle;
    },
  },
};
</script>

<style lang="scss">
  .z-section {
    position: relative;
    height: var(--section-height);
    padding: var(--section-padding);
    margin: var(--section-margin, 2.25rem 0);
    background: var(--section-background);
    color: var(--section-color);

    @media (min-width: 640px) {
      padding: var(--section-desktop-padding, var(--section-padding));
      margin: var(--section-desktop-margin, var(--section-margin, 5.5rem 0));
    }

    &::before {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--section-overlay-background);
      content: "";
      opacity: var(--section-overlay-opacity);
    }

    &__header {
      position: relative;
      display: grid;
      max-width: var(--section-header-max-width, 1140px);
      padding: var(--section-header-padding, 0 1.25rem);
      margin: var(--section-header-margin, 0 auto 1.5rem auto);
      grid-template-columns: var(--section-header-grid-template-columns, repeat(12, minmax(auto, 1fr)));
    }

    &__title {
      grid-column: var(--section-title-grid-column, span 12);
      grid-row: var(--section-title-grid-row, 1);

      @media (min-width: 640px) {
        grid-column: var(--section-title-grid-column, span 6);
      }
    }

    &__subtitle {
      margin: var(--section-title-margin, 0.75rem 0 0 0);
      grid-column: var(--section-subtitle-grid-column, span 12);
      grid-row: var(--section-subtitle-grid-row, 2);

      @media (min-width: 640px) {
        --section-subtitle-grid-column: span 6;
      }
    }

    &__content {
      position: relative;
      display: grid;
      max-width: var(--section-content-max-width, 1140px);
      height: var(--section-content-height);
      min-height: var(--section-content-min-height);
      align-items: var(--section-content-align-items);
      justify-content: var(--section-content-justify-content);
      padding: var(--section-content-padding, 0 1.25rem);
      margin: var(--section-content-margin, auto);
      background-size: var(--section-content-background-size);
      gap: var(--section-content-gap, 1.25rem);
      grid-template-columns: var(--section-content-grid-template-columns, repeat(12, minmax(auto, 1fr)));
    }

    &__more {
      --link-color: #7ba22e;

      margin: 1rem 0 0 0;
      grid-column: span 12;
      text-decoration: underline;

      &:hover {
        text-decoration: none;
      }

      @media (min-width: 640px) {
        grid-column: span 6;
        grid-row: var(--section-more-grid-row, 3);
      }
    }
  }
</style>
