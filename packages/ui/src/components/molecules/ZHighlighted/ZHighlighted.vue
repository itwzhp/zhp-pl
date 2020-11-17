<template>
  <component
    :is="tag"
    class="z-highlighted"
  >
    <ZHeading class="t4 uppercase">
      {{ title }}
    </ZHeading>
    <ZList>
      <template v-for="(article, key) in posts">
        <li
          :key="key"
          class="z-highlighted__item"
        >
          <ZLink
            :to="`${slug}/${article.slug}`"
            class="z-highlighted__link"
          >
            {{ article.title }}
          </ZLink>
          <time
            :datetime="article.date"
            class="body-2"
          >{{ article.date | format }}</time>
        </li>
      </template>
    </ZList>
    <ZLink
      :to="`/${slug}`"
      class="z-highlighted__more z-highlighted__link"
    >
      {{ more }}
    </ZLink>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZList from '../../organisms/ZList/ZList.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'ZHighlighted',
  components: {
    ZHeading,
    ZLink,
    ZList,
    ZText,
  },
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
      type: String,
      default: 'Zobacz więcej',
    },
    posts: {
      type: Array,
      default: () => ([]),
    },
    slug: {
      type: String,
      default: 'aktualnosci',
    },
  },
};
</script>

<style lang="scss">
  .z-highlighted {
    --link-text-decoration: underline;

    display: grid;

    &__more {
      color: #7ba22e;
      place-self: end;
    }

    &__item {
      display: grid;
      justify-content: space-between;
      margin: 16px 0;
      grid-column-gap: 2rem;
      grid-template-columns: repeat(2, auto);
    }

    &__link {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;

      &:hover {
        --link-text-decoration: none;
      }
    }
  }
</style>
