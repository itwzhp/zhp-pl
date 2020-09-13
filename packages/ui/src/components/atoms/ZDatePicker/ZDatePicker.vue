<template>
  <component
    :is="tag"
    class="z-date-picker"
  />
</template>

<script>
import flatpickr from 'flatpickr';

export default {
  name: 'ZDatePicker',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
  },
  mounted() {
    flatpickr(this.$el, { inline: true, mode: 'range' });
  },
};
</script>

<style lang="scss">
  @import '~flatpickr/dist/flatpickr.css';
  .z-date-picker {}
</style>
