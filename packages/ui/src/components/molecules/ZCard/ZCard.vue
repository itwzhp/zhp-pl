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
          <ZHeading
            class="z-card__title"
            :level="3"
          >
            <ZLink
              :to="to"
              v-text="title"
            />
          </ZHeading>
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
  grid-template-rows: 128px 1fr;

  &__thumbnail {
    position: relative;
    overflow: hidden;
    line-height: 0;

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

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }

  &__content {
    padding: 16px 24px;
  }

  &__title {
    color: #78a22f;
    font-size: 20px;
    font-weight: 500;
    text-transform: var(--text-transform);
  }

  &--uppercase {
    --text-transform: uppercase;
  }
}
</style>