<template>
  <component
    :is="tag"
    class="z-card"
  >
    <slot name="thumb">
      <ZImage
        class="z-card__thumb"
        :src="srcImage"
        :sources="sourcesImage"
        :alt="title"
      />
    </slot>
    <slot name="title">
      <ZLink :to="toLink">
        <ZHeading
          level="3"
        >
          {{ title }}
        </ZHeading>
      </ZLink>
    </slot>
    <slot name="content">
      <ZText>
        {{ content }}
      </ZText>
    </slot>
    <slot name="author">
      <ZLink :to="author.to">
        {{ author.name }}
      </ZLink>
    </slot>
    <slot name="categories">
      <ZLink
        v-for="(category, key) in categories"
        :key="key"
        :to="category.to"
      >
        {{ category.name }}
      </ZLink>
    </slot>
  </component>
</template>
<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'ZCard',
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
    title: {
      type: String,
      default: '',
    },
    content: {
      type: String,
      default: '',
    },
    author: {
      type: Object,
      default: () => ({}),
    },
    date: {
      type: String,
      default: '',
    },
    categories: {
      type: Array,
      default: () => ([]),
    },
    toLink: {
      type: [Object, String],
      default: () => ({}),
    },
    srcImage: {
      type: String,
      default: '',
    },
    sourcesImage: {
      type: Array,
      default: () => ([]),
    },
  },
};
</script>
<style lang="scss">
  .z-card {}
</style>
