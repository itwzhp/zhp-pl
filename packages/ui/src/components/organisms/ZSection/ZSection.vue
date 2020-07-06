<template>
  <component
    :is="tag"
    class="z-section"
  >
    <slot name="title">
      <ZHeading class="l-container">{{ title }}</ZHeading>
    </slot>
    <slot name="subtitle">
      <ZText class="l-container">{{ subtitle }}</ZText>
    </slot>
    <slot />
  </component>
</template>
<script>
  import ZHeading from "../../atoms/ZHeading/ZHeading";
  import ZText from "../../atoms/ZText/ZText";
  export default {
    name: "ZSection",
    components: {ZText, ZHeading},
    props: {
      tag: {
        type: String,
        default: "section"
      },
      title: {
        type: String,
        default: ""
      },
      subtitle: {
        type: String,
        default: ""
      },
      levelHeading: {
        type: [String, Number],
        default: "2"
      }
    }
  }
</script>
<style lang="scss">
  .z-section {
  }
</style>
