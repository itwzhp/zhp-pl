<template>
  <component
    :is="tag"
    class="z-mega-menu"
    :class="{'is-open': isOpen}"
  >
    <ZButton
      class="z-button--text z-mega-menu__toggler"
      @click="toggle"
      aria-label="menu"
    >
      <ZIcon :name="icon" />
    </ZButton>
    <nav
      ref="menu"
      class="z-mega-menu__holder"
    >
      <ZList class="z-mega-menu__menu">
        <template v-for="item in menu">
          <ZListItem
            :key="item.id"
            class="z-mega-menu__item"
          >
            <template v-if="item.submenu">
              <ZLink
                class="z-mega-menu__link body-1"
                tag="span"
                tabindex="0"
                @click="submenuHandler(item.submenu.name)"
              >
                {{ item.name }}
              </ZLink>
            </template>
            <template v-else>
              <ZLink
                class="z-mega-menu__link body-1"
                :to="item.to"
                :tag="item.submenu && 'span'"
              >
                {{ item.name }}
              </ZLink>
            </template>
            <ZMegaMenuDropdown
              v-if="item.submenu"
              :menu="item.submenu"
              class="z-mega-menu__submenu"
              :class="{'is-open': submenu === item.submenu.name}"
            />
          </ZListItem>
        </template>
      </ZList>
    </nav>
  </component>
</template>

<script>
import Vue from 'vue';
import { disableBodyScroll, clearAllBodyScrollLocks } from 'body-scroll-lock';

import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZList from '../ZList/ZList.vue';
import ZMegaMenuDropdown from './_internal/ZMegaMenuDropdown.vue';

Vue.component('ZMegaMenuDropdown', ZMegaMenuDropdown);

export default {
  name: 'ZMegaMenu',
  components: {
    ZLink,
    ZList,
    ZButton,
    ZIcon,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    menu: {
      type: Array,
      default: () => ([]),
    },
  },
  data() {
    return {
      isOpen: false,
      isMobile: false,
      submenu: '',
    };
  },
  computed: {
    icon() {
      return this.isOpen ? 'cross' : 'menu';
    },
  },
  watch: {
    isOpen(isOpen) {
      if (isOpen) {
        disableBodyScroll(this.$refs.menu);
      } else {
        clearAllBodyScrollLocks();
      }
    },
    isMobile() {
      clearAllBodyScrollLocks();
      this.isOpen = false;
      this.submenu = '';
    },
  },
  mounted() {
    matchMedia('(max-width: 480px)').addListener((e) => { this.isMobile = e.matches; });
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    },
    close() {
      this.isOpen = false;
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

  &__toggler {
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
      overflow-y: scroll;
    }

    .is-open & {
      display: block;
    }
  }

  &__menu {
    display: grid;

    @media (min-width: 480px) {
      gap: 1.5rem;
      grid-auto-flow: column;
    }
  }

  &__submenu {
    display: none;

    &.is-open {
      @media (max-width: 480px) {
        display: grid;
      }
    }

    @media (min-width: 480px) {
      position: absolute;
      z-index: 10;
      right: 0;
      left: 0;
    }

    .z-mega-menu__item:hover &,
    .z-mega-menu__item:focus-within & {
      @media (min-width: 480px) {
        display: grid;
      }
    }
  }
}
</style>
