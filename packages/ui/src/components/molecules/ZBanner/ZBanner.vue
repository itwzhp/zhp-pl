<template>
  <component
    :is="tag"
    class="z-banner"
  >
    <div
      v-if="thumbnail"
      class="z-banner__cover"
    >
      <div class="z-banner__mask">
        <ZImage
          v-if="coverType === 'image'"
          class="z-banner__thumbnail"
          :src="thumbnail"
        />
        <ZVideo
          v-else
          class="z-banner__thumbnail"
          :src="thumbnail"
        />
      </div>
    </div>
    <div class="z-banner__content">
      <slot name="title">
        <ZHeading
          class="z-banner__title"
        >
          {{ title }}
        </ZHeading>
      </slot>
      <slot name="content">
        <ZText
          class="z-banner__description"
        >
          {{ content }}
        </ZText>
      </slot>
      <slot name="call-to-actions">
        <div class="z-banner__call-to-actions">
          <template v-for="(action, key) in actions">
            <slot name="link">
              <div
                :key="key"
                class="z-banner__call-to-action"
              >
                <ZLink
                  :to="action.to"
                  class="z-banner__link"
                >
                  {{ action.name }}
                </ZLink>
                <ZIcon
                  name="chevron"
                  style="--icon-size: 0.876rem;"
                />
              </div>
            </slot>
          </template>
        </div>
      </slot>
    </div>
  </component>
</template>

<script>

import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZVideo from '../../atoms/ZVideo/ZVideo.vue';

export default {
  name: 'ZBanner',
  components: {
    ZImage,
    ZVideo,
    ZIcon,
    ZLink,
    ZText,
    ZHeading,
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
    thumbnail: {
      type: [String, Object],
      default: '',
    },
    coverType: {
      type: String,
      default: 'image',
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
    overflow: hidden;
    min-height: 392px;
    background: var(--banner-background, #78a22f);
    border-radius: var(--banner-border-radius, 10px);
    box-shadow: 5px 5px 20px 0 rgba(0, 0, 0, 0.16);
    color: var(--banner-color, #fff);
    grid-template-columns: repeat(12, 1fr);
    grid-template-rows: repeat(2, auto);

    @media (min-width: 480px) {
      grid-template-rows: 1fr;
    }

    &__cover {
      display: block;
      margin: -1px;
      grid-column: span 12;
      grid-row: 1;

      @media (min-width: 480px) {
        grid-column: 7 / span 6;
      }
    }

    &__mask {
      position: relative;
      overflow: hidden;
      height: 100%;
      box-sizing: content-box;
      padding: 10% 0;
      margin: -10% 0;

      @media (min-width: 480px) {
        border-radius: var(--banner-mask-border-radius, 20% 0 0 20% / 50% 0 0 50%);
      }

      &::before {
        @media (min-width: 480px) {
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          background: var(--color-primary);
          content: "";
          opacity: 0.4;
        }
      }
    }

    &__thumbnail {
      &,
      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }

    &__content {
      position: relative;
      z-index: 1;
      display: grid;
      align-content: end;
      padding: var(--banner-content-padding, 24px);
      grid-auto-flow: row;
      grid-column: 1 / span 12;
      grid-row: 2;
      grid-template-columns: repeat(12, 1fr);

      @media (min-width: 480px) {
        grid-row: 1;
      }
    }

    &__title {
      margin: var(--banner-title-margin, 0 0 1rem 0);
      font-size: var(--banner-title-font-size, var(--font-size-h4));
      font-weight: 900;
      grid-column: var(--banner-title-grid-column, span 12);
      grid-row: var(--banner-title-grid-row, 1);
      text-transform: var(--banner-title-text-transform, uppercase);

      @media (min-width: 480px) {
        grid-column: var(--banner-title-grid-column, span 8);
      }
    }

    &__description {
      margin: var(--banner-description-margin, 0 0 2rem 0);
      font-size: var(--banner-title-font-size, var(--font-size-subtitle-1));
      font-weight: 300;
      grid-column: var(--banner-description-grid-column, span 12);
      grid-row: var(--banner-description-grid-row, 2);

      @media (min-width: 480px) {
        grid-column: var(--banner-description-grid-column, span 8);
      }
    }

    &__call-to-actions {
      display: grid;
      gap: 1.5rem;
      grid-column: var(--banner-call-to-actions-grid-column, span 12);
      grid-row: var(--banner-call-to-actions-grid-row, 3);

      @media (min-width: 480px) {
        grid-auto-flow: column;
        grid-column: var(--banner-call-to-actions-grid-column, span 11);
      }
    }

    &__call-to-action {
      --icon-color: #fff;

      display: grid;
      align-items: center;
      justify-content: start;
      color: #fff;
      column-gap: 16px;
      grid-auto-flow: column;
    }

    &__link {
      --link-text-decoration: underline;

      white-space: nowrap;

      &:hover {
        --link-text-decoration: none;
      }
    }
  }
</style>
