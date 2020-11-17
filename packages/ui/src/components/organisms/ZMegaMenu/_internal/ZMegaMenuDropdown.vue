<template>
  <div class="z-mega-menu-dropdown">
    <ZSection>
      <template v-for="submenu in menu">
        <div
          :key="submenu.id"
          class="z-mega-menu-dropdown__column"
        >
          <ZText class="z-mega-menu-dropdown__title body-1 bold">
            {{ submenu.name }}
          </ZText>
          <ZList>
            <template v-for="link in submenu.mega_menu">
              <ZListItem :key="link.id">
                <ZLink :to="link.to">
                  {{ link.name }}
                </ZLink>
              </ZListItem>
            </template>
          </ZList>
        </div>
      </template>
    </ZSection>
  </div>
</template>

<script>
import ZSection from '../../ZSection/ZSection.vue';
import ZLink from '../../../atoms/ZLink/ZLink.vue';
import ZList from '../../ZList/ZList.vue';
import ZText from '../../../atoms/ZText/ZText.vue';

export default {
  name: 'ZMegaMenuDropdown',
  components: {
    ZSection,
    ZLink,
    ZList,
    ZText,
  },
  props: {
    menu: {
      type: Array,
      default: () => ([]),
    },
  },
};
</script>

<style lang="scss">
  .z-mega-menu-dropdown {
    --section-content-padding: 0;
    --section-margin: 0;
    --section-content-gap: 0;

    @media (min-width: 480px) {
      --section-content-gap: 1.25rem;
      --section-content-padding: 0 1.25rem;
      --section-margin: 1rem 0;

      background: #fff;
    }

    &__column {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 3;
      }
    }

    &__title {}
  }
</style>
