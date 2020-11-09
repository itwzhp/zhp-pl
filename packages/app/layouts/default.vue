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
            class="z-header__logo"
            style="--image-width: 8.75rem;"
          />
        </ZLink>
        <div class="z-header__actions z-header__actions--right">
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
      <ZMegaMenu :menu="headerMenu" />
    </header>
    <Nuxt />
    <footer class="z-footer">
      <ZSection class="z-footer__content">
        <ZDidYouKnow
          :random-text="randomText"
          class="z-footer__random"
        />
        <div class="z-footer__scouting">
          <ZImage
            :src="require('~/assets/wagggs.png')"
            class="z-footer__scouting-logo"
          />
          <ZImage
            :src="require('~/assets/wosm.png')"
            class="z-footer__scouting-logo"
          />
        </div>
      </ZSection>
      <div class="z-footer__bar">
        <ZText
          class="z-footer__copyright subtitle-2"
          tag="div"
        >
          Copyright © 1997-{{ year }}<span class="br" /> Związek Harcerstwa Polskiego
        </ZText>
        <ZMenu
          class="z-menu--horizontal z-footer__menu"
          :menu="footerMenu"
        />
      </div>
    </footer>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import {
  ZText,
  ZSection,
  ZDidYouKnow,
  ZImage,
  ZLink,
  ZDropdown,
  ZIcon,
  ZButton,
  ZMenu,
  ZMegaMenu
} from '@nowa-zhp/ui'

export default {
  name: 'Default',
  components: {
    ZText,
    ZSection,
    ZDidYouKnow,
    ZImage,
    ZLink,
    ZDropdown,
    ZIcon,
    ZButton,
    ZMenu,
    ZMegaMenu
  },
  async middleware ({ store, $axios }) {
    if (!Object.keys(store.getters['menus/menu']).length) {
      const menusRes = await $axios.get('menus')
      const menus = menusRes.data
      const locations = {
        'header-menu': 'headerMenu',
        'footer-menu': 'footerMenu'
      }
      menus.forEach((menu) => {
        store.commit('menus/update', { location: locations[menu.location], items: menu.items })
      })
    }
    if (!Object.keys(store.getters['random/text']).length) {
      const randomRes = await $axios.get('random')
      const { text } = randomRes.data
      store.commit('random/update', text)
    }
    const tax = ['age_groups'] // categories
    tax.forEach(async (taxonomy) => {
      if (!store.getters['taxonomies/taxonomy'](taxonomy)) {
        const itemsRes = await $axios.get(taxonomy, { params: { per_page: 99 } })
        const items = itemsRes.data
        store.commit('taxonomies/update', { name: taxonomy, items })
      }
    })
  },
  data () {
    return {
      isOpen: false,
      megaMenu: [
        {
          name: 'Strona Główna',
          to: '/'
        },
        {
          name: 'Aktualności',
          to: '/aktualnosci'
        },
        {
          name: 'Wydarzenia',
          to: '/wydarzenia'
        },
        {
          name: 'Dla rodzica',
          to: '',
          submenu: [
            {
              name: 'Członkowie organizacji',
              menu: [
                {
                  name: 'Zuchy',
                  to: '/zuchy'
                },
                {
                  name: 'Harcerze',
                  to: '/harcerze'
                }
              ]
            },
            {
              name: 'Dla rodziców',
              menu: [
                {
                  name: 'Poradnik rodzica',
                  to: '/poradnik-rodzica'
                },
                {
                  name: 'Bezpieczeństwo dzieci',
                  to: '/bezpieczenstwo-dzieci'
                },
                {
                  name: '1 procent',
                  to: '/procen'
                }
              ]
            }
          ]
        },
        {
          name: 'Intranet ZHP',
          to: '/intranet'
        },
        {
          name: 'Dla mediów',
          to: '/dla-mediow'
        },
        {
          name: 'Kontakt',
          to: '/kontakt'
        }
      ]
    }
  },
  computed: {
    ...mapGetters({
      randomText: 'random/text'
    }),
    headerMenu () {
      return this.$store.getters['menus/menu']('headerMenu')
    },
    footerMenu () {
      return this.$store.getters['menus/menu']('footerMenu')
    },
    year () {
      return new Date().getFullYear()
    }
  },
  methods: {
    toggle () {
      this.isOpen = !this.isOpen
    },
    close () {
      this.isOpen = false
    }
  }
}
</script>

<style lang="scss">
.z-header {
  display: grid;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  grid-auto-flow: column;

  @media (max-width: 480px) {
    position: sticky;
    z-index: 1000;
    top: 0;
  }

  @media (min-width: 480px) {
    max-width: 1370px;
    justify-content: unset;
    margin: 0 auto;
    grid-auto-flow: row;
  }

  &__bar {
    display: grid;
    height: 5rem;
    align-items: center;

    @media (min-width: 480px) {
      justify-content: space-between;
      grid-template-columns: repeat(3, minmax(auto, 1fr));
    }
  }

  &__actions {
    display: none;

    @media (min-width: 480px) {
      --icon-size: var(--font-size-button);
      --icon-margin: 0 1rem 0 0;
      --icon-color: var(--color-primary);
      --button-color: var(--color-primary);

      display: grid;
      justify-content: start;
      padding: 0 1.25rem;
      gap: 1rem;
      grid-auto-flow: column;
    }

    &--right {
      justify-content: end;
    }
  }

  &__logo {
    --image-width: 8.75rem;

    padding: 0 1.25rem;
  }

  &__nav {
    background: transparent;
  }
}

.z-footer {
  padding: 1rem 0 0 0;
  background: var(--color-primary-lighten);

  &__content {
    --section-margin: 0 auto !important;
    --section-background: var(--color-primary-darken);
  }

  &__random {
    /* TODO: setup height in ZDidYouKnow -> rename to ZRandomText */
    color: #fff;
    grid-column: span 12;

    @media (min-width: 480px) {
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

    &-logo {
      /* TODO: height */
      background: transparent;
    }
  }

  &__bar {
    display: grid;
    max-width: 1140px;
    align-items: center;
    padding: 1rem 1.25rem;
    margin: 0 auto;
    color: #fff;
    gap: 2rem;

    @media (min-width: 480px) {
      height: 3rem;
      align-items: center;
      justify-content: center;
      padding: 0 1.25rem;
      gap: 0;
      grid-auto-flow: column;
    }

    .br {
      display: block;

      @media (min-width: 480px) {
        display: inline;
      }
    }
  }
}
</style>
