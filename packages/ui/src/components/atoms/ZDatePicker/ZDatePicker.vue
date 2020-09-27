<template>
  <component
    :is="tag"
    class="z-date-picker"
  />
</template>

<script>
import flatpickr from 'flatpickr';
import { Polish } from 'flatpickr/dist/l10n/pl';

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
      minDate: '2020',
      maxDate: new Date(),
      locale: Polish,
      inline: true,
      mode: 'range',
      defaultDate: this.value,
      onValueUpdate: (selectedDates) => {
        if (selectedDates.length === 2) {
          this.$emit('input', selectedDates.map((date) => (new Date(date).toISOString())));
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

  .flatpickr {
    &-day {
      &:nth-child(7n+0) {
        border-radius: 0 50px 50px 0;
        box-shadow: none !important;

        &::after {
          box-shadow: none !important;
        }
      }

      &:nth-child(7n+1) {
        border-radius: 50px 0 0 50px;
        box-shadow: none !important;

        &::after {
          box-shadow: none !important;
        }
      }

      &.today {
        &,
        &.inRange {
          border: 0;
          color: #78a22f;

          &:hover {
            background-color: #a6ce39;
            color: #fff;
          }
        }

        &.inRange {
          background-color: #fff;

          &:hover {
            background-color: #fff;
            color: #78a22f;
          }
        }
      }

      &.selected.startRange,
      &.startRange.startRange,
      &.endRange.startRange,
      &.selected.endRange,
      &.startRange.endRange,
      &.endRange.endRange {
        border: 0 !important;
        background: #a6ce39;
        border-radius: 50%;
        box-shadow: none !important;
        color: #fff;

        &::after {
          position: absolute;
          z-index: -1;
          width: 50%;
          height: 100%;
          background: #fff;
          box-shadow: -5px 0 0 #fff, 5px 0 0 #fff;
          content: "";
        }
      }

      &.selected.startRange,
      &.startRange.startRange {
        &::after {
          right: 0;
        }
      }

      &.selected.endRange,
      &.endRange.endRange {
        &::after {
          left: 0;
        }
      }

      &.endRange.startRange {
        &::after {
          content: none;
        }
      }

      &.inRange {
        &,
        &.nextMonthDay:not(.endRange),
        &.prevMonthDay:not(.endRange) {
          border: 0;
          background: #fff;
          box-shadow: -5px 0 0 #fff, 5px 0 0 #fff;
        }
      }
    }

    &-weekdays {
      display: none;
    }

    &-months {
      .flatpickr-prev-month,
      .flatpickr-next-month {
        fill: #7ba22e;

        &:hover svg {
          fill: #7ba22e;
        }
      }
    }

    &-innerContainer {
      margin: 56px 0 0 0;
    }

    &-current-month {
      color: #7ba22e;

      .flatpickr-monthDropdown-months,
      .numInputWrapper {
        background: transparent;
        text-transform: uppercase;

        &:hover {
          background: transparent;
        }
      }

      .flatpickr-monthDropdown-months {
        width: auto;
        -webkit-appearance: none;
        -moz-appearance: none;
      }

      .numInputWrapper {
        width: auto;

        span {
          &.arrowUp,
          &.arrowDown {
            display: none;
          }
        }
      }

      input.cur-year[disabled] {
        color: #7ba22e;
      }
    }
  }
</style>
