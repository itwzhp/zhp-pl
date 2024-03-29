<template>
  <div
    class="layout"
    :class="{'layout--mourning': hasMourning}"
  >
    <header class="z-header">
      <div class="z-header__bar">
        <div class="z-header__actions" />
        <div class="z-header__logo">
          <ZLink
            to="/"
            aria-label="powrót do strony głównej"
          >
            <ZImage
              :src="require('~/assets/brand.svg')"
              style="--image-width: 8.75rem;"
            />
          </ZLink>
        </div>
        <div class="z-header__actions z-header__actions--right">
          <ZDropdown class="z-language z-dropdown--has-chevron">
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text uppercase"
                @click="toggle"
              >
                {{ selectedLanguage }}
              </ZButton>
            </template>
            <template>
              <ZList>
                <template v-for="(language, key) in languages">
                  <ZListItem :key="key">
                    <ZLink
                      :to="language.href"
                      class="z-language__link"
                    >
                      {{ language.name }}
                    </ZLink>
                  </ZListItem>
                </template>
              </ZList>
            </template>
          </ZDropdown>
          <ZDropdown class="z-districts z-dropdown--has-chevron">
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text"
                @click="toggle"
              >
                Chorągwie ZHP
              </ZButton>
            </template>
            <template>
              <ZList>
                <template v-for="(choragiew, key) in choragwie">
                  <ZListItem :key="key">
                    <ZLink
                      :to="choragiew.href"
                      class="z-districts__link"
                    >
                      {{ choragiew.name }}
                    </ZLink>
                  </ZListItem>
                </template>
              </ZList>
            </template>
          </ZDropdown>
          <ZDropdown class="z-groups z-dropdown--right z-dropdown--has-chevron">
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text"
                @click="toggle"
              >
                Grupa ZHP
              </ZButton>
            </template>
            <template>
              <ZList>
                <template v-for="(jednostka, key) in grupaZHP">
                  <ZListItem :key="key">
                    <ZLink
                      :to="jednostka.href"
                      class="z-groups__link"
                    >
                      {{ jednostka.name }}
                    </ZLink>
                  </ZListItem>
                </template>
              </ZList>
            </template>
          </ZDropdown>
        </div>
      </div>
      <ZMegaMenu :menu="headerMenu" />
    </header>
    <Nuxt class="layout__page" />
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
          <ZLink to="/copyright">
            Copyright
          </ZLink> © 1997-{{ year }}<span class="br" /> Związek Harcerstwa Polskiego
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
  ZButton,
  ZMenu,
  ZMegaMenu,
  ZList
} from '@zhp-pl/ui'

export default {
  components: {
    ZText,
    ZSection,
    ZDidYouKnow,
    ZImage,
    ZLink,
    ZDropdown,
    ZButton,
    ZMenu,
    ZMegaMenu,
    ZList
  },
  async middleware ({ store, $axios }) {
    if (!Object.keys(store.state.theme.options).length) {
      const optionsRes = await $axios.get('options')
      const options = optionsRes.data
      store.dispatch('theme/update', options)
    }
    if (!Object.keys(store.state.menus).length) {
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
    const tax = ['age_groups', 'event_types', 'localizations', 'categories'] // categories
    await Promise.all(
      tax.map(async (taxonomy) => {
        if (!store.getters['taxonomies/taxonomy'](taxonomy)) {
          const itemsRes = await $axios.get(taxonomy, { params: { per_page: 99, orderby: 'name' } })
          const items = itemsRes.data
          store.commit('taxonomies/update', { name: taxonomy, items })
        }
      })
    )
    if (!Object.keys(store.state.posts.posts).length) {
      const postParams = {
        per_page: 9,
        categories: 82
      }
      const postsRes = await $axios.get('posts', { params: postParams })
      const posts = postsRes.data
      store.commit('posts/update', posts)
    }
    if (!Object.keys(store.state.cards.posts).length) {
      const tags = [{ id: 433, name: '>>' }, { id: 427, name: '>>>' }]
      await Promise.all(
        tags.map(async (tag) => {
          const postRes = await $axios.get('posts', { params: { per_page: 1, tags: tag.id, _embed: true } })
          const post = postRes.data.shift()
          store.dispatch('cards/update', { name: tag.name, post })
        })
      )
    }
  },
  data () {
    return {
      isOpen: false,
      choragwie: [
        { name: 'Białostocka', href: 'http://bialostocka.zhp.pl/' },
        { name: 'Dolnośląska', href: 'http://dolnoslaska.zhp.pl/' },
        { name: 'Gdańska', href: 'https://gdanska.zhp.pl/' },
        { name: 'Kielecka', href: 'https://kielecka.zhp.pl/' },
        { name: 'Krakowska', href: 'https://krakowska.zhp.pl/' },
        { name: 'Kujawsko-Pomorska', href: 'https://kp.zhp.pl/' },
        { name: 'Lubelska', href: 'https://lubelska.zhp.pl/' },
        { name: 'Łódzka', href: 'https://lodzka.zhp.pl/' },
        { name: 'Mazowiecka', href: 'https://mazowiecka.zhp.pl/' },
        { name: 'Opolska', href: 'https://opolska.zhp.pl/' },
        { name: 'Podkarpacka', href: 'http://podkarpacka.zhp.pl/' },
        { name: 'Stołeczna', href: 'https://stoleczna.zhp.pl/' },
        { name: 'Śląska', href: 'https://slaska.zhp.pl/' },
        { name: 'Warmińsko-Mazurska', href: 'http://wm.zhp.pl/' },
        { name: 'Wielkopolska', href: 'http://www.zhp.wlkp.pl/' },
        { name: 'Zachodniopomorska', href: 'http://zachpom.zhp.pl/' },
        { name: 'Ziemi Lubuskiej', href: 'http://lubuska.zhp.pl/' }
      ],
      grupaZHP: [
        { name: 'Muzeum Harcerstwa', href: 'https://muzeumharcerstwa.pl/' },
        { name: 'CSH 4 Żywioły', href: 'https://4zywioly.pl/' },
        { name: 'SZAiL (Konopnickiej6)', href: 'https://szal.pl/' },
        { name: 'Fundacja Szlaki Przygody', href: 'https://fsj.zhp.pl/' },
        { name: 'Komitet Organizacyjny Jamboree', href: 'https://jamboree2027.org' }
      ],
      cookies: false
    }
  },
  computed: {
    ...mapGetters({
      randomText: 'random/text',
      hasMourning: 'theme/hasMourning'
    }),
    headerMenu () {
      return this.$store.getters['menus/menu']('headerMenu')
    },
    footerMenu () {
      return this.$store.getters['menus/menu']('footerMenu')
    },
    year () {
      return new Date().getFullYear()
    },
    languages () {
      return [
        { name: 'en', href: '/en' },
        { name: 'fr', href: '/fr' },
        { name: 'es', href: '/es' },
        { name: 'ru', href: '/ru' },
        { name: 'pl', href: '/' }
      ].filter(language => (language.name !== this.selectedLanguage))
    },
    selectedLanguage () {
      const languages = ['en', 'fr', 'es', 'ru']
      return languages.includes(this.$route.params.slug) ? this.$route.params.slug : 'pl'
    }
  },
  mounted () {
    if (localStorage.getItem('cookies')) { return }
    this.cookies = true
    setTimeout(this.closeCookies, 60000)
  },
  methods: {
    toggle () {
      this.isOpen = !this.isOpen
    },
    close () {
      this.isOpen = false
    },
    closeCookies () {
      this.cookies = false
      localStorage.setItem('cookies', JSON.stringify(true))
    },
    search (query) {
      if (!query.trim().length) { return }
      this.$router.push({
        path: '/szukaj',
        query: { search: query, subtype: 'post' }
      })
    }
  }
}
</script>

<style lang="scss">
#__nuxt {
  background-color: #fff;
  background-image: url('~assets/background.png');
  background-position-x: center;
  background-repeat: repeat-y;
  background-size: 100% auto;
  //-webkit-font-smoothing: antialiased;
  //-moz-osx-font-smoothing: grayscale;
  //text-rendering: optimizeLegibility;
}

.z-header {
  display: grid;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  grid-auto-flow: column;

  @media (max-width: 640px) {
    position: sticky;
    z-index: 1000;
    top: 0;
  }

  @media (min-width: 640px) {
    width: 100%;
    max-width: 1360px;
    justify-content: unset;
    margin: 0 auto;
    grid-auto-flow: row;
  }

  &__bar {
    display: grid;
    height: 5rem;
    align-items: center;

    @media (min-width: 640px) {
      justify-content: space-between;
      grid-template-columns: repeat(3, minmax(auto, 1fr));
    }
  }

  &__actions {
    display: none;

    @media (min-width: 640px) {
      --icon-size: var(--font-size-button);
      --icon-margin: 0 1rem 0 0;
      --icon-color: var(--color-primary);
      --button-color: var(--color-primary);

      display: grid;
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

    display: grid;
    justify-content: center;
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

    @media (min-width: 640px) {
      grid-column: span 4;
    }
  }

  &__scouting {
    display: grid;
    order: -1;
    margin: 32px 0;
    grid-column: 3 / span 8;

    @media (min-width: 640px) {
      order: 0;
      margin: 0;
      grid-auto-flow: column;
      grid-column: 9 / span 4;
    }

    &-logo {
      margin: 0 0 24px 0;
      background: transparent;

      &:last-of-type {
        margin: 0;
      }

      @media (min-width: 640px) {
        margin: 0;
      }
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

    @media (min-width: 640px) {
      height: 3rem;
      align-items: center;
      justify-content: center;
      padding: 0 1.25rem;
      gap: 0;
      grid-auto-flow: column;
    }

    .br {
      display: block;

      @media (min-width: 640px) {
        display: inline;
      }
    }
  }
}

.z-language {
  --list-item: 0;
  --link-hover-text-decoration: none;
  --dropdown-content-width: 35px;
  --dropdown-content-padding: 16px 0;
  --dropdown-content-transform: translateY(0);

  &__link {
    display: inline-flex;
    width: 100%;
    padding: 4px 8px;
    text-transform: uppercase;
    transition:
      color 150ms ease-in-out,
      background-color 150ms ease-in-out;

    &:hover {
      background: var(--color-primary);
      color: #fff;
    }
  }
}

.z-districts,
.z-groups {
  --button-color: var(--color-primary-darken);
  --list-item: 0;
  --link-hover-text-decoration: none;
  --dropdown-content-width: 160px;
  --dropdown-content-padding: 16px 0;
  --dropdown-content-transform: translateY(0);

  z-index: 1000;

  &__link {
    display: inline-flex;
    width: 100%;
    padding: 4px 8px;
    transition:
      color 150ms ease-in-out,
      background-color 150ms ease-in-out;

    &:hover {
      background: var(--color-primary);
      color: #fff;
    }
  }
}

.layout {
  display: flex;
  min-height: 100vh;
  flex-direction: column;

  &__page {
    flex: 1;
  }

  &--mourning {
    filter: grayscale(1);
  }
}

.cookies {
  position: fixed;
  z-index: 100;
  bottom: 0;
  left: 0;
}
</style>
