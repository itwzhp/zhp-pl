<template>
  <component
    :is="tag"
    class="z-pagination"
  >
    <ZButton
      v-if="previousUnavailable"
      class="z-pagination__previous"
      @click="change(-1)"
    >
      <ZIcon name="arrow-left" />
    </ZButton>
    <ZButton
      v-if="nextUnavailable"
      class="z-pagination__next"
      @click="change(1)"
    >
      <ZIcon name="arrow-right" />
    </ZButton>
  </component>
</template>

<script>
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';

export default {
  name: 'ZPagination',
  components: {
    ZButton,
    ZIcon,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    page: {
      type: [Number, String],
      default: 0,
    },
    totalPages: {
      type: [Number, String],
      default: 0,
    },
  },
  computed: {
    nextUnavailable() {
      return parseInt(this.page, 10) < parseInt(this.totalPages, 10);
    },
    previousUnavailable() {
      return parseInt(this.page, 10) > 1;
    },
  },
  methods: {
    change(direction) {
      const newPage = parseInt(this.page, 10) + direction;
      this.$emit('change', `${newPage}`);
    },
  },
};
</script>

<style lang="scss">
  .z-pagination {
    display: grid;
    justify-content: end;
    grid-column-gap: 8px;
    grid-template-columns: repeat(2, 34px);

    &__previous,
    &__next {
      --icon-color: #fff;
      --button-min-width: none;
      --button-width: 34px;
      --button-height: 34px;
      --button-padding: 0;
    }

    &__next {
      grid-column: 2;
    }

    &__previous {
      grid-column: 1;
    }
  }
</style>
