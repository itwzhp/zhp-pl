<template>
  <component
    :is="tag"
    class="z-pagination"
  >
    <ZButton
      class="z-pagination__previous"
      @click="change(-1)"
    >
      <ZIcon name="arrow-left" />
    </ZButton>
    <ZButton
      class="z-pagination__next"
      @change="change(1)"
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
      type: Number,
      default: 0,
    },
    totalPages: {
      type: Number,
      default: 0,
    },
  },
  methods: {
    change(direction) {
      this.$emit('change', this.page + direction);
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
    }

    &__next {
      grid-column: 2;
    }

    &__previous {
      grid-column: 1;
    }
  }
</style>
