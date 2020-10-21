<template>
  <component
    :is="tag"
    class="z-card"
  >
    <slot name="thumbnail">
      <div class="z-card__thumbnail">
        <ZImage
          :src="thumbnail"
          alt=""
        />
      </div>
    </slot>
    <slot name="content">
      <div class="z-card__content">
        <slot name="heading">
          <ZLink
            :to="to"
            class="z-card__title t6"
          >
            {{ title }}
          </ZLink>
        </slot>
        <slot name="description">
          <ZText class="z-card__description caption">{{description}}</ZText>
        </slot>
      </div>
    </slot>
  </component>
</template>

<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'Zcard',
  components: {
    ZImage,
    ZLink,
    ZHeading,
    ZText,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    thumbnail: {
      type: [Object, String],
      default: '',
    },
    title: {
      type: String,
      default: '',
    },
    description: {
      type: String,
      default: '',
    },
    to: {
      type: [Object, String],
      default: () => ({}),
    },
  },
};
</script>

<style lang="scss">
.z-card {
  $this: &;

  display: grid;
  overflow: hidden;
  border-radius: 10px;
  box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
  grid-template-rows: 1fr 128px;

  &__thumbnail {
    position: relative;
    overflow: hidden;

    &::after {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: #fff;
      content: "";
      transform: translateY(-8px);
    }

    & .z-image,
    & img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }

  &__content {
    display: grid;
    align-items: end;
    padding: 16px 24px;
    grid-auto-flow: row;
  }

  &__title {
    color: #78a22f;
    text-transform: var(--text-transform);
  }

  &__description {
    color: #fff;
  }

  &--uppercase {
    text-transform: uppercase;
  }

  &--pictured {
    grid-template-rows: auto auto;

    #{$this}__title {
      color: #fff;
    }
    #{$this}__thumbnail {
      grid-column: 1;
      grid-row: 1 / span 2;

      &::after {
        content: none;
      }
    }
    #{$this}__content {
      z-index: 1;
      align-items: end;
      grid-column: 1;
      grid-row: 2;
    }
  }

  &--overlayed {
    grid-template-rows: auto auto;

    #{$this}__thumbnail {
      position: relative;

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
  }
}
</style>
