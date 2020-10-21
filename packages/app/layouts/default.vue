<template>
  <div>
    <header class="z-header">
      <div class="z-header__bar">
        <div class="z-header__actions">
          <ZDropdown>
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text"
                @click="toggle"
              >
                <ZIcon
                  name="shuffle"
                /> Zmień serwis
              </ZButton>
            </template>
          </ZDropdown>
        </div>
        <ZLink
          to="/"
          aria-label="powrót do strony głównej"
        >
          <ZImage
            :src="require('~/assets/brand.svg')"
            class="z-logo"
            style="--image-width: 8.75rem;"
          />
        </ZLink>
        <div class="z-header__actions">
          <ZDropdown>
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text"
                @click="toggle"
              >
                Wyszukaj
              </ZButton>
            </template>
          </ZDropdown>
          <ZDropdown>
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text"
                @click="toggle"
              >
                Język
              </ZButton>
            </template>
          </ZDropdown>
          <ZDropdown>
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text"
                @click="toggle"
              >
                <ZIcon
                  name="wheelchair"
                /> Dostosuj
              </ZButton>
            </template>
          </ZDropdown>
        </div>
      </div>
      <div class="z-header__navigation">
        <ZButton
          class="z-header__mobile z-button--text"
          @click="toggle"
        >
          <template v-if="menuIsOpen">
            <ZIcon
              name="cross"
            />
          </template>
          <template v-else>
            <ZIcon
              name="menu"
            />
          </template>
        </ZButton>
        <!-- TODO: rename this element -->
        <div
          ref="menu"
          class="z-header__menu"
          :class="{'is-active': menuIsOpen}"
        >
          <nav class="z-menu">
            <template v-for="(item, key) in headerMenu">
              <ZLink
                :key="key"
                :to="item.to"
                class="z-menu__item"
                @click.native="toggle"
              >
                {{ item.name }}
              </ZLink>
            </template>
          </nav>
        </div>
      </div>
    </header>
    <Nuxt />
    <footer class="z-footer">
      <ZSection class="z-footer__content">
        <ZDidYouKnow
          :random-text="randomText"
          class="z-footer__random-text"
        />
        <div class="z-footer__scouting">
          <ZImage
            :src="require('~/assets/wagggs.png')"
            class=""
          />
          <ZImage
            :src="require('~/assets/wosm.png')"
            class=""
          />
        </div>
      </ZSection>
      <div class="z-footer__bar">
        <ZText class="subtitle-2">
          Copyright © 1997-{{ year }}<span class="z-footer__br" /> Związek Harcerstwa Polskiego
        </ZText>
        <nav class="z-menu z-menu--secondary z-footer__menu">
          <template v-for="(item, key) in footerMenu">
            <ZLink
              :key="key"
              :to="item.to"
              class="z-menu__item"
            >
              {{ item.name }}
            </ZLink>
          </template>
        </nav>
      </div>
    </footer>
  </div>
</template>

<script>
import { disableBodyScroll, clearAllBodyScrollLocks } from 'body-scroll-lock'
import { mapGetters } from 'vuex'
import {
  ZImage,
  ZLink,
  ZDropdown,
  ZButton,
  ZIcon,
  ZText,
  ZSection,
  ZDidYouKnow
} from '@nowa-zhp/ui'

export default {
  name: 'Default',
  components: {
    ZImage,
    ZLink,
    ZDropdown,
    ZButton,
    ZIcon,
    ZText,
    ZSection,
    ZDidYouKnow
  },
  async middleware ({ store, $axios }) {
    // vuex store is required to get data on server-side
    if (!Object.keys(store.getters['menus/headerMenu']).length ||
      Object.keys(!store.getters['menus/footerMenu']).length) {
      const menusRes = await $axios.get('menus')
      const menus = menusRes.data
      menus.forEach((menu) => {
        switch (menu.location) {
          case 'header-menu':
            store.commit('menus/update', {
              location: 'headerMenu',
              items: menu.items.map(item => ({
                name: item.title,
                to: item.url
              }))
            })
            break
          case 'footer-menu':
            store.commit('menus/update', {
              location: 'footerMenu',
              items: menu.items.map(item => ({
                name: item.title,
                to: item.url
              }))
            })
            break
        }
      })
    }
    if (!Object.keys(store.getters['random/text']).length) {
      const randomTextRes = await $axios.get('random')
      const randomText = randomTextRes.data
      store.commit('random/update', randomText.text)
    }

    const taxonomies = ['age_groups']
    taxonomies.forEach(async (taxonomy) => {
      if (!store.getters['taxonomies/taxonomy'](taxonomy)) {
        const items = await $axios.get(taxonomy, { params: { per_page: 99 } })
        store.commit('taxonomies/update', { name: taxonomy, items: items.data })
      }
    })
  },
  data () {
    return {
      menuIsOpen: false
    }
  },
  computed: {
    ...mapGetters(
      {
        headerMenu: 'menus/headerMenu',
        footerMenu: 'menus/footerMenu',
        randomText: 'random/text'
      }),
    year () {
      const today = new Date()
      return today.getFullYear()
    }
  },
  watch: {
    menuIsOpen (isOpen) {
      if (isOpen) {
        disableBodyScroll(this.$refs.menu)
      } else {
        clearAllBodyScrollLocks()
      }
    }
  },
  methods: {
    toggle () {
      this.menuIsOpen = !this.menuIsOpen
    }
  }
}
</script>

<style lang="scss">
.z-header {
  display: grid;
  overflow: hidden;
  align-items: center;
  justify-content: space-between;
  grid-auto-flow: column;

  @media (min-width: 480px) {
    justify-content: unset;
    grid-auto-flow: row;
  }

  &__bar {
    display: grid;
    height: 5rem;
    align-items: center;
    justify-content: space-between;
    padding: 0 1.25rem;
    grid-template-columns: repeat(3, auto);
  }

  &__actions {
    display: none;

    @media (min-width: 480px) {
      --icon-size: var(--font-size-button);
      --icon-margin: 0 1rem 0 0;
      --icon-color: var(--color-primary);
      --button-color: var(--color-primary);

      display: grid;
      gap: 1rem;
      grid-auto-flow: column;
    }
  }

  &__navigation {
    display: grid;
    height: 3.125rem;
    align-items: center;
    grid-auto-flow: column;
  }

  /* TODO: rename to more descriptive name */
  &__mobile {
    --icon-color: #7ba22e;
    --icon-size: 1.5rem;

    margin: 0 1.25rem;

    @media (min-width: 480px) {
      display: none;
    }
  }

  &__menu {
    @media (max-width: 480px) {
      position: absolute;
      z-index: 1000; /* TODO: fix this z-index */
      top: 5rem;
      right: 0;
      bottom: 0;
      left: 0;
      display: none;
      padding: 1.25rem;
      background: #fff;
    }

    &.is-active {
      @media (max-width: 480px) {
        display: block;
      }
    }
  }
}

.z-footer {
  padding: 1rem 0 0 0;
  background: var(--color-primary-lighten);

  &__content {
    --section-margin: 0 auto !important; /* FIXME: remove this !important */
    --section-background: var(--color-primary-darken);

    @media (min-width: 480px) {
      --section-margin: 0 auto !important; /* FIXME: remove this !important */
    }
  }

  &__random-text {
    margin: 1rem 0;
    color: #fff;
    grid-column: span 12;

    @media (min-width: 480px) {
      --section-margin: 0 auto;

      margin: 1.87rem 0;
      grid-column: span 4;
    }
  }

  &__scouting {
    display: grid;
    order: -1;
    margin: 1rem 0;
    grid-column: span 12;

    @media (min-width: 480px) {
      order: 0;
      margin: 0;
      grid-auto-flow: column;
      grid-column: 9 / span 4;
    }
  }

  &__bar {
    display: grid;
    max-width: 1140px;
    padding: 1rem 1.25rem;
    margin: 0 auto;
    color: #fff;
    gap: 1rem;

    @media (min-width: 480px) {
      height: 3rem;
      align-items: center;
      justify-content: center;
      padding: 0 1.25rem;
      gap: 0;
      grid-auto-flow: column;
    }
  }

  &__br {
    display: block;

    @media (min-width: 480px) {
      display: inline;
    }
  }
}

.z-menu {
  --link-font-size: var(--font-size-h6);

  display: grid;
  align-items: center;
  gap: var(--menu-gap, 1.5rem);
  grid-auto-flow: row;

  @media (min-width: 480px) {
    justify-content: center;
    grid-auto-flow: column;
  }

  &--secondary {
    --link-font-size: var(--font-size-subtitle-2);
    --link-font-weight: 300;
    --menu-gap: 1rem;

    @media (min-width: 480px) {
      --menu-gap: 0;
    }

    .z-menu {
      &__item {
        &::before {
          @media (min-width: 480px) {
            margin: 0 0.25rem;
            content: "|";
          }
        }
      }
    }
  }
}
</style>
