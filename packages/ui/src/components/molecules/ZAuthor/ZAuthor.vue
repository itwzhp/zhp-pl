<template>
  <component
    :is="tag"
    class="z-author"
  >
    <slot name="avatar">
      <ZImage
        :src="avatarUrl"
        class="z-author__avatar"
      />
    </slot>
    <slot name="name">
      <ZLink
        to="#"
        class="z-author__name"
      >
        {{ name }}
      </ZLink>
    </slot>
  </component>
</template>

<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';

export default {
  name: 'ZAuthor',
  components: {
    ZImage,
    ZLink,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    name: {
      type: String,
      default: '',
    },
    avatarUrl: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="scss">
.z-author {
  display: grid;
  align-items: center;
  justify-content: start;
  column-gap: 8px;
  grid-template-columns: repeat(2, auto);

  &__avatar {
    display: flex;
    overflow: hidden;
    width: 32px;
    border-radius: 50%;
  }

  &__name {}
}
</style>
