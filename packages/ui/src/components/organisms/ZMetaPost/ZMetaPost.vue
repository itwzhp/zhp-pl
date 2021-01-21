<template>
  <component
    :is="tag"
    class="z-meta"
  >
    <ZAuthor
      class="z-meta__author"
      :name="author.name"
      :avatar-url="author.avatarUrl"
    />
    <div class="z-meta__categories">
      <template v-for="(category, key) in categories">
        <ZLink
          :key="key"
          :to="{name: 'aktualnosci', query: {categories: `${category.id}`}}"
          class="z-meta__category"
          v-html="category.name"
        />
      </template>
    </div>
    <div class="z-meta__date button">
      {{ date | format }}
    </div>
    <div class="z-meta__reading button">
      ~ {{ readingTime }} min czytania
    </div>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZAuthor from '../../molecules/ZAuthor/ZAuthor.vue';

export default {
  name: 'ZMetaPost',
  filters: {
    format(date) {
      if (!date) {
        return '';
      }
      return format(new Date(date), 'dd/MM/yyyy');
    },
  },
  components: {
    ZImage,
    ZLink,
    ZAuthor,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    author: {
      type: Object,
      default: () => ({
        name: '',
        avatarUrl: '',
      }),
    },
    date: {
      type: String,
      default: '',
    },
    readingTime: {
      type: Number,
      default: 0,
    },
    categories: {
      type: Array,
      default: () => ([]),
    },
  },
};
</script>

<style lang="scss">
.z-meta {
  display: grid;
  align-items: center;
  justify-content: space-between;
  grid-template-columns: repeat(2, auto);
  grid-template-rows: repeat(2, auto);
  row-gap: 4px;

  &__author {}

  &__categories {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    margin: -4px 0 0 0;
  }

  &__category {
    margin: 4px 4px 0 0;

    &::after {
      content: ", ";
    }

    &:last-of-type {
      margin: 4px 0 0 0;
      &::after {
        content: none;
      }
    }
  }

  &__date {}

  &__reading {
    color: #a6ce39;
    text-align: right;
  }
}
</style>
