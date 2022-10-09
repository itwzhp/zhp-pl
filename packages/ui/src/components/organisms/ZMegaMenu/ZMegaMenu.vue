<template>
  <component
    :is="tag"
    class="z-mega-menu"
    :class="{'is-open': isOpen}"
  >
    <ZButton
      class="z-button--text z-mega-menu__toggler"
      aria-label="menu"
      @click="toggle"
    >
      <ZIcon :name="icon" />
    </ZButton>
    <nav
      ref="menu"
      class="z-mega-menu__holder"
    >
      <ZList class="z-mega-menu__menu">
        <template v-for="item in menu">
          <template v-if="item.submenu && !item.isClassic">
            <ZListItem
              :key="item.id"
              class="z-mega-menu__item"
              tabindex="0"
              @mouseover="submenuHandlerOpen(item.id)"
              @focus="submenuHandlerOpen(item.id)"
              @mouseleave="submenuHandlerClose"
            >
              <ZLink
                class="z-mega-menu__link body-1"
                tag="span"
                @click="submenuHandlerMobile(item.id)"
              >
                {{ item.name }}
              </ZLink>
              <ZMegaMenuDropdown
                v-if="item.id === submenu"
                :menu="item.submenu"
                class="z-mega-menu__submenu"
                :class="{'is-open': submenu === item.id}"
                @close="close"
              />
            </ZListItem>
          </template>
          <template v-if="item.submenu && item.isClassic">
            <ZDropdown class="z-classic-menu z-dropdown--has-chevron">
              <template #toggle="{toggle}">
                <ZButton
                  class="z-button--text"
                  @click="toggle"
                >
                  {{ item.name }}
                </ZButton>
              </template>
              <template>
                <ZList>
                  <template v-for="subitem in item.submenu">
                    <ZListItem :key="subitem.id">
                      <ZLink
                        :to="subitem.to"
                        class="z-classic-menu__link"
                      >
                        {{ subitem.name }}
                      </ZLink>
                    </ZListItem>
                  </template>
                </ZList>
              </template>
            </ZDropdown>
          </template>
          <template v-else>
            <ZListItem
              :key="item.id"
              class="z-mega-menu__item"
            >
              <ZLink
                class="z-mega-menu__link body-1"
                :to="item.to"
                :tag="item.submenu && 'span'"
                @click.native="close"
                @focus.native="submenuHandlerClose"
              >
                {{ item.name }}
              </ZLink>
            </ZListItem>
          </template>
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
import ZDropdown from '../../molecules/ZDropdown/ZDropdown.vue';
import ZMegaMenuDropdown from './_internal/ZMegaMenuDropdown.vue';

Vue.component('ZMegaMenuDropdown', ZMegaMenuDropdown);

export default {
  name: 'ZMegaMenu',
  components: {
    ZLink,
    ZList,
    ZButton,
    ZIcon,
    ZDropdown
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
      el: null,
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
    this.isMobile = matchMedia('(max-width: 640px)').matches;
    matchMedia('(max-width: 640px)').addListener((e) => { this.isMobile = e.matches; });
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
      this.submenu = -1;
    },
    close() {
      this.isOpen = false;
      this.submenu = -1;
    },
    submenuHandlerOpen(submenu) {
      if (this.isMobile) return;
      this.submenu = submenu;
    },
    submenuHandlerClose() {
      if (this.isMobile) return;
      this.submenu = -1;
    },
    submenuHandlerMobile(submenu) {
      if (!this.isMobile) return;
      this.submenu = this.submenu === submenu
        ? -1
        : submenu;
    },
  },
};
</script>

<style lang="scss">
.z-mega-menu {
  .nuxt-link-active {
    color: var(--color-primary);
  }

  display: grid;
  align-items: center;
  justify-content: center;
  grid-auto-flow: column;

  @media (min-width: 640px) {
    height: 3.125rem;
  }

  &__toggler {
    --icon-color: #7ba22e;
    --icon-size: 1.5rem;

    margin: 0 1.25rem;

    @media (min-width: 640px) {
      display: none;
    }
  }

  &__holder {
    @media (max-width: 640px) {
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

    @media (min-width: 640px) {
      gap: 1.5rem;
      grid-auto-flow: column;
    }
  }

  &__submenu {
    display: none;

    &.is-open {
      display: grid;
    }

    @media (min-width: 640px) {
      position: absolute;
      z-index: 1000;
      right: 0;
      left: 0;
    }

    //.z-mega-menu__item:hover &,
    //.z-mega-menu__item:focus-within & {
    //  @media (min-width: 640px) {
    //    display: grid;
    //  }
    //}
  }
}
</style>
