<template>
  <component
    :is="tag"
    class="z-mega-menu"
    :class="{'is-active': open}"
  >
    <ZButton
      class="z-button--text z-mega-menu__toggle"
      @click="toggle"
    >
      <template v-if="open">
        <ZIcon name="cross" />
      </template>
      <template v-else>
        <ZIcon name="menu" />
      </template>
    </ZButton>
    <nav class="z-mega-menu__holder">
      <ZList class="z-mega-menu__menu">
        <template v-for="(item, key) in menu">
          <li
            :key="key"
            class="z-mega-menu__item"
          >
            <template v-if="Object.keys(item.submenu).length">
              <ZLink @click.native.prevent="submenuHandler(item.name)">
                {{ item.name }}
              </ZLink>
              <div
                class="z-mega-menu__submenu submenu"
                :class="{'is-active': submenu === item.name}"
              >
                <ZSection>
                  <template v-for="(submenu, index) in item.submenu">
                    <div
                      :key="index"
                      class="submenu__block"
                    >
                      <ZText class="submenu__title">
                        {{ submenu.name }}
                      </ZText>
                      <ZList class="submenu__menu">
                        <template v-for="(link, id) in submenu.menu">
                          <li :key="id">
                            <ZLink :to="link.to">
                              {{ link.name }}
                            </ZLink>
                          </li>
                        </template>
                      </ZList>
                    </div>
                  </template>
                </ZSection>
              </div>
            </template>
            <template v-else>
              <ZLink :to="item.to">
                {{ item.name }}
              </ZLink>
            </template>
          </li>
        </template>
      </ZList>
    </nav>
  </component>
</template>

<script>
import { disableBodyScroll, clearAllBodyScrollLocks } from 'body-scroll-lock';
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZList from '../ZList/ZList.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZSection from '../ZSection/ZSection.vue';

export default {
  name: 'ZMegaMenu',
  components: {
    ZButton,
    ZIcon,
    ZList,
    ZLink,
    ZText,
    ZSection,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    menu: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      open: false,
      submenu: '',
    };
  },
  watch: {
    open(isOpen) {
      if (isOpen) {
        disableBodyScroll(this.$el);
      } else {
        clearAllBodyScrollLocks();
      }
    },
  },
  methods: {
    toggle() {
      this.open = !this.open;
    },
    close() {
      this.open = false;
    },
    submenuHandler(submenu) {
      this.submenu = this.submenu === submenu
        ? ''
        : submenu;
    },
  },
};
</script>

<style lang="scss">
.z-mega-menu {
  display: grid;
  align-items: center;
  justify-content: center;
  grid-auto-flow: column;

  @media (min-width: 480px) {
    height: 3.125rem;
  }

  &__toggle {
    --icon-color: #7ba22e;
    --icon-size: 1.5rem;

    margin: 0 1.25rem;

    @media (min-width: 480px) {
      display: none;
    }
  }

  &__holder {
    @media (max-width: 480px) {
      position: absolute;
      top: 5rem;
      left: 0;
      display: none;
      width: 100%;
      height: calc(100vh - 5rem);
      padding: 1.25rem;
      background: #fff;
    }

    .is-active & {
      display: block;
    }
  }

  &__item {
    &:hover {
      .z-mega-menu__submenu {
        @media (min-width: 480px) {
          display: grid;
        }
      }
    }
  }

  &__menu {
    display: grid;
    gap: 1.5rem;

    @media (min-width: 480px) {
      grid-auto-flow: column;
    }
  }

  &__submenu {
    --section-margin: 1.25rem 0;

    display: none;
    background: #fff;

    @media (max-width: 480px) {
      --section-content-padding: 0;
    }

    @media (min-width: 480px) {
      --section-margin: 2.5rem;

      position: absolute;
      z-index: 1000;
      right: 0;
      left: 0;
    }

    &.is-active {
      display: grid;
    }
  }

  .submenu {
    &__block {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 3;
      }
    }

    // &__title {}

    &__menu {
      display: grid;
      gap: 0.25rem;
    }
  }
}
</style>
