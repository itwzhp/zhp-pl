<template>
  <component
    :is="tag"
    class="z-highlighted"
  >
    <div class="z-highlighted__header">
      <ZHeading v-text="title" />
      <ZLink
        :to="more.href"
        class="z-highlighted__more z-highlighted__link"
        v-text="more.title"
      />
    </div>
    <ZList>
      <template v-for="(article, key) in articles">
        <li
          :key="key"
          class="z-highlighted__item"
        >
          <ZLink
            to="#"
            class="z-highlighted__link"
            v-text="article.title"
          />
          <time
            :datetime="article.date"
          >{{ article.date | format }}</time>
        </li>
      </template>
    </ZList>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZList from '../../organisms/ZList/ZList.vue';

export default {
  name: 'ZHighlighted',
  components: { ZHeading, ZLink, ZList },
  filters: {
    format(date) {
      if (!date) {
        return '';
      }
      return format(new Date(date), 'dd.MM.yyyy');
    },
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
    more: {
      type: Object,
      default: () => ({}),
    },
    articles: {
      type: Array,
      default: () => ([]),
    },
  },
};
</script>

<style lang="scss">
  .z-highlighted {
    --link-text-decoration: underline;

    &__header {
      display: grid;
      align-items: center;
      justify-content: space-between;
      grid-template-columns: repeat(2, auto);
    }

    &__title {
      font-weight: 500;
      text-transform: uppercase;
    }

    &__more {
      color: #7ba22e;
    }

    &__item {
      display: grid;
      justify-content: space-between;
      margin: 16px 0;
      grid-template-columns: repeat(2, auto);
    }

    &__link {
      &:hover {
        --link-text-decoration: none;
      }
    }
  }
</style>
