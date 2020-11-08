<template>
  <component
    :is="tag"
    class="z-banner"
  >
    <div
      v-if="thumbnail"
      class="z-banner__cover"
    >
      <svg style="height: 0; width: 0; position: absolute">
        <clipPath
          id="banner"
          clipPathUnits="objectBoundingBox"
        ><path d="M0.098,0 C0.098,0,0.098,0,0.098,0 L0.985,0 L0.985,0 C0.987,0,0.989,0.001,0.991,0.002 C0.992,0.003,0.994,0.005,0.996,0.007 C0.997,0.009,0.998,0.012,0.999,0.015 C1,0.018,1,0.021,1,0.024 V0.976 C1,0.979,1,0.982,0.999,0.985 C0.998,0.988,0.997,0.991,0.996,0.993 C0.994,0.995,0.992,0.997,0.991,0.998 C0.989,0.999,0.987,1,0.985,1 H0.097 C0.097,1,0.097,1,0.097,0.999 C0.096,0.999,0.096,0.998,0.095,0.997 C0.094,0.995,0.093,0.992,0.091,0.988 C0.088,0.98,0.084,0.968,0.079,0.952 C0.069,0.922,0.057,0.878,0.046,0.827 C0.022,0.724,0,0.59,0,0.465 C0,0.34,0.025,0.224,0.049,0.139 C0.061,0.096,0.074,0.061,0.083,0.037 C0.087,0.025,0.091,0.016,0.094,0.009 C0.095,0.006,0.096,0.004,0.097,0.002 C0.097,0.001,0.098,0.001,0.098,0" /></clipPath>
      </svg>
      <ZImage
        v-if="coverType === 'image'"
        class="z-banner__thumbnail z-banner__thumbnail--image"
        v-bind="thumbnail"
      />
      <ZVideo
        v-else
        class="z-banner__thumbnail"
        v-bind="thumbnail"
      />
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
// eslint-disable-next-line import/no-extraneous-dependencies
import { uid } from 'uid/single';

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
    id() {
      return uid();
    },
  },
};
</script>

<style lang="scss">
  .z-banner {
    display: grid;
    overflow: hidden;
    min-height: var(--banner-min-height, 392px);
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

    &__thumbnail {
      position: relative;
      z-index: var(--banner-thumbnail-z-index);
      @media (min-width: 480px) {
        clip-path: url(#banner);
      }

      &--image {
        &::before {
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          background: #78a22f;
          content: "";
          opacity: 0.4;
        }
      }
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
