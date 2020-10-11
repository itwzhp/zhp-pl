<template>
  <component
    :is="tag"
    :datetime="date"
    class="z-date"
  >
    <div class="z-date__day medium">
      {{ day }}
    </div>
    <div class="z-date__month caption normal">
      {{ month }}
    </div>
  </component>
</template>

<script>
export default {
  name: 'ZDate',
  props: {
    tag: {
      type: String,
      default: 'time',
    },
    date: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      months: ['Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'Paź', 'Lis', 'Gru'],
    };
  },
  computed: {
    day() {
      const date = new Date(this.date);
      return date.getDate().toString().padStart(2, '0');
    },
    month() {
      const date = new Date(this.date);
      return this.months[date.getMonth()];
    },
  },
};
</script>

<style lang="scss">
.z-date {
  display: grid;
  width: 40px;
  height: 48px;
  padding: 4px 0;
  background: var(--date-background, #fff);
  border-radius: 5px;
  color: #1e152f;
  grid-template-rows: repeat(2, auto);

  &__day {
    place-self: center;
  }

  &__month {
    place-self: center;
  }

  &__separator {
    width: 16px;
    height: 4px;
    background: var(--date-background, #fff);
    border-radius: 2px;
  }
}
</style>
