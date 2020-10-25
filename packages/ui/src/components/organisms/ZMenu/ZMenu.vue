<template>
  <component
    :is="tag"
    class="z-menu"
  >
    <ZList class="z-menu__items">
      <template v-for="(item, key) in menu">
        <li
          :key="key"
          class="z-menu__item"
        >
          <ZLink
            :to="item.to"
            class="z-menu__link subtitle-2"
          >
            {{ item.name }}
          </ZLink>
        </li>
      </template>
    </ZList>
  </component>
</template>

<script>
import ZList from '../ZList/ZList.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';

export default {
  name: 'ZMenu',
  components: {
    ZList,
    ZLink,
  },
  props: {
    tag: {
      type: String,
      default: 'nav',
    },
    menu: {
      type: Object,
      default: () => ({}),
    },
  },
};
</script>

<style lang="scss">
.z-menu {
  &__items {
    display: grid;
    gap: 1rem 0;

    @media (min-width: 480px) {
      gap: 0;
    }
  }

  &__item {
    display: grid;
    align-items: center;
    grid-auto-flow: column;

    &::before {
      @media (min-width: 480px) {
        margin: 0 4px;
        content: "|";
        font-size: 14px;
      }
    }
  }

  //&__link {}

  &--horizontal {
    .z-menu {
      &__items {
        @media (min-width: 480px) {
          grid-auto-flow: column;
        }
      }
    }
  }
}
</style>
