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
    value: {
      type: Array,
      default: () => ([]),
    },
  },
  mounted() {
    flatpickr(this.$el, {
      inline: true,
      mode: 'range',
      defaultDate: this.value,
      onValueUpdate: (selectedDates) => {
        if (selectedDates.length === 2) {
          this.$emit('input', selectedDates);
        }
      },
    });
  },
};
</script>

<style lang="scss">
  @import '~flatpickr/dist/flatpickr.css';

  .z-date-picker {

    & + .flatpickr-calendar {
      background: transparent;
      box-shadow: none;
    }
  }
</style>
