<template>
  <component
    :is="tag"
    class="z-banner"
  >
    <slot name="title">
      <ZHeading>{{ title }}</ZHeading>
    </slot>
    <slot name="content">
      <ZText>{{ content }}</ZText>
    </slot>
    <slot name="callToAction">
      <ZLink
        v-for="(callToAction, key) in callToActions"
        :key="key"
        :to="callToAction.href"
      >
        {{ callToAction.name }}
      </ZLink>
    </slot>
    <slot name="thumb">
      <ZImage
        :src="srcImage"
        :sources="sourcesImage"
        :alt="title"
      />
    </slot>
  </component>
</template>
<script>
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZImage from '../../atoms/ZImage/ZImage.vue';

export default {
  name: 'ZBanner',
  components: {
    ZHeading,
    ZText,
    ZLink,
    ZImage,
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
    callToActions: {
      type: Array,
      default: () => ([]),
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
  .z-banner {}
</style>
