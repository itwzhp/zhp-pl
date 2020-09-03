<template>
  <component
    :is="tag"
    class="z-banner"
  >
    <slot name="title">
      <ZHeading
        class="z-banner__title"
        v-text="title"
      />
    </slot>
    <slot name="content">
      <ZText
        class="z-banner__content"
        v-text="content"
      />
    </slot>
    <slot name="cta">
      <div class="z-banner__cta">
        <template v-for="(action, key) in actions">
          <slot name="link">
            <div
              :key="key"
              class="z-banner__link"
            >
              <ZLink
                :to="action.href"
                v-text="action.name"
              />
              <ZIcon name="chevron" />
            </div>
          </slot>
        </template>
      </div>
    </slot>
  </component>
</template>
<script>

import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';

export default {
  name: 'ZBanner',
  components: {
    ZIcon, ZLink, ZText, ZHeading,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    title: {
      type: String,
      default: '',
    },
    content: {
      type: String,
      default: '',
    },
    callsToAction: {
      type: [Array, Object],
      default: () => ([]),
    },
  },
  computed: {
    actions() {
      return Array.isArray(this.callsToAction) ? this.callsToAction : [this.callsToAction];
    },
  },
};
</script>
<style lang="scss">
  .z-banner {
    display: grid;
    height: 392px;
    align-content: end;
    padding: var(--banner-padding, 24px);
    background: var(--banner-background, linear-gradient(135deg, rgba(123, 162, 46, 1) 8%, rgba(166, 206, 57, 1) 70%));
    border-radius: var(--banner-border-radius, 10px);
    color: var(--banner-color, #fff);

    &__title {
      order: var(--banner-title-order);
      margin: var(--banner-title-margin, 16px 0);
      font-size: var(--banner-title-font-size, 1.953rem);
      font-weight: var(--banner-title-font-weight, 500);
      text-transform: var(--banner-title-text-transform, uppercase);
    }

    &__content {
      order: var(--banner-content-order);
      margin: var(--banner-content-margin, 16px 0);
      font-weight: var(--banner-content-font-weight, 300);
    }

    &__cta {
      display: grid;
      grid-auto-flow: column;
    }

    &__link {
      --icon-color: #fff;
      --link-text-decoration: underline;

      display: grid;
      align-items: center;
      justify-content: start;
      color: #fff;
      column-gap: 16px;
      font-size: 16px;
      grid-auto-flow: column;
      white-space: nowrap;

      &:hover {
        --link-text-decoration: none;
      }
    }
  }
</style>
