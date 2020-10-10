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
      </div>
    </slot>
  </component>
</template>

<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';

export default {
  name: 'Zcard',
  components: {
    ZImage,
    ZLink,
    ZHeading,
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
    to: {
      type: [Object, String],
      default: () => ({}),
    },
  },
};
</script>

<style lang="scss">
.z-card {
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
    align-items: center;
    padding: 16px 24px;
    grid-auto-flow: row;
  }

  &__title {
    color: #78a22f;
    text-transform: var(--text-transform);
  }

  &--uppercase {
    text-transform: uppercase;
  }
}
</style>
