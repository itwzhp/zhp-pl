<template>
  <div
    class="layout"
    :class="{'layout--mourning': hasMourning}"
    :style="cssVars()"
  >
 
    <header class="z-header">
      <div class="z-header__bar">
        <div class="z-header__actions" />
        <div class="z-header__logo">
          <ZLink
            v-if="!hasHeaderLogos"
            to="/"
            aria-label="powrót do strony głównej"
          >
            <ZImage
              :src="require('~/assets/brand.svg')"
              style="--image-width: 8.75rem;"
            />
          </ZLink>

          <ZLink
            v-for="(logo,key) in headerLogos"
            v-if="hasHeaderLogos && logo " 
            :key="key"
            to="/"
            aria-label="powrót do strony głównej"
          >
            <ZImage 
              :src="logo"
              style="--image-width: 8.75rem"
              />
          </ZLink>
        </div>
        <div class="z-header__actions z-header__actions--right">
          <ZDropdown class="z-districts z-dropdown--right z-dropdown--has-chevron">
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text"
                @click="toggle"
              >
                {{ headerUnitsLabel }}
              </ZButton>
            </template>
            <template>
              <ZList>
                <template v-for="(unit, key) in headerUnits">
                  <ZListItem :key="key">
                    <ZLink
                      :to="unit.to"
                      class="z-districts__link"
                    >
                      {{ unit.name }}
                    </ZLink>
                  </ZListItem>
                </template>
              </ZList>
            </template>
          </ZDropdown>
        </div>
      </div>
      <ZMegaMenu :menu="megaMenu" />
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
          </ZLink> ©{{ year }} {{ title }}
        </ZText>
        <ZMenu
          class="z-menu--horizontal z-footer__menu"
          :menu="footerMenu"
        />
      </div>
    </footer>
    <ZCookies
      v-if="cookies"
      class="cookies"
      @close="closeCookies"
    />
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
  ZMenu,
  ZMegaMenu,
  ZCookies,
  ZDropdown,
  ZList,
  ZButton
} from '@zhp-pl/ui'
import UrlParser from '../helpers/UrlParser'

export default {
  components: {
    ZText,
    ZSection,
    ZDidYouKnow,
    ZImage,
    ZLink,
    ZMenu,
    ZMegaMenu,
    ZCookies,
    ZDropdown,
    ZList,
    ZButton
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
        'footer-menu': 'footerMenu',
        'header-units': 'headerUnits'
      }
      menus.forEach((menu) => {
        store.commit('menus/update', { 
          location: locations[menu.location], 
          items: menu.items, // todo: konwersja URL z absolutnych do relatywnych
          name: menu.name 
        })
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
    // Warto przeczytać on single post page
    if (!Object.keys(store.state.posts.posts).length) {
      const postsRes = await $axios.get('posts', { params: { per_page: 9 } })
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
      cookies: false,
      isMobile: false
    }
  },
  computed: {
    ...mapGetters({
      randomText: 'random/text',
      hasMourning: 'theme/hasMourning',
      title: 'theme/title',
      favicon: 'theme/favicon',
      headerLogos: 'theme/headerLogos',
      hasHeaderLogos: 'theme/hasHeaderLogos'
    }),
    headerMenu () {
      return this.filterMenu(this.$store.getters['menus/menu']('headerMenu'))
    },
    megaMenu () {
      const headerMenu = [...this.headerMenu]
      const headerUnits = [...this.headerUnits]
      if (this.isMobile && headerUnits.length > 0) {
        headerMenu.push({
          name: this.headerUnitsLabel,
          to: '#',
          submenu: [{
            name: '',
            to: '',
            mega_menu: headerUnits
          }]
        })
      }
      return headerMenu
    },
    footerMenu () {
      return this.filterMenu(this.$store.getters['menus/menu']('footerMenu'))
    },
    headerUnits () {
      return this.$store.getters['menus/menu']('headerUnits')
    },
    headerUnitsLabel () {
      return this.$store.getters['menus/menuName']('headerUnits')
    },
    year () {
      return new Date().getFullYear()
    }
  },
  mounted () {
    this.isMobile = matchMedia('(max-width: 640px)').matches
    matchMedia('(max-width: 640px)').addListener((e) => { this.isMobile = e.matches })
    if (localStorage.getItem('cookies')) { return }
    this.cookies = true
    setTimeout(this.closeCookies, 60000)
  },
  methods: {
    filterMenu(menuLinks){
        const parser = new UrlParser(this.$store);
        return menuLinks.map((item)=> 'to' in item? {...item, to: parser.parse(item.to)}: item);
    },
    closeCookies () {
      this.cookies = false
      localStorage.setItem('cookies', JSON.stringify(true))
    },
    cssVars(){
      let colors = this.$store.getters['theme/colors'];
      return {
        '--button-background': colors['button_background'],
        '--color-primary': colors['primary_color'],
        '--color-primary-darken': colors['primary_darken'],
        '--button-color': colors['button_text'],
        '--button-text-color':  colors['primary_darken'],
        '--color-primary-lighten': colors['primary_lighten'],
        '--theme-input-background': colors['input_background'],
        '--input-background': colors['input_background'],
        '--input-border-color':  colors['input_background'],
        '--theme-input-color':  colors['input_text'],
        '--input-color': colors['input_text'],
        '--icon-color': colors['input_text'],
        '--z-meta-text-color': colors['primary_lighten'],
        '--z-filter-posts--categories-toggle--background': colors['primary_darken'],
        '--z-card--title--text-color': colors['primary_darken'],
        '--banner-background': colors['banner_background'],
        '--z-banner--image-overlay-color': colors['banner_overlay'],
        '--z-did-you-know--question-marks--color': colors['question_marks'],
        '--highlighted-text-color':colors['highlighted_text'],
        '--form-field-label-color':colors['form_field_label_color'],
        '--select-border': colors['select_border'],
        '--flatpicker-text-color': colors['flatpicker_text_color'],
        '--flatpicker-selected-color': colors['flatpicker_selected_color'],
        '--bubble-uncheck-background': colors['bubble_uncheck_background'],
        '--bubble-checked-background': colors['bubble_checked_background'],
        '--bubble-label-border': colors['bubble_uncheck_background'],
        '--card-image-overlay-color':colors['card_overlay'],
        '--menu-toggler-color': colors['menu_toggler_color']
      }
    },  
  },
  head(){
      let links = Object.entries(this.favicon).map((options, index)=>{return {
          hid: 'icon-'+options[0]+'x'+options[0],
          rel: 'icon',
          type: 'image/png',
          sizes: options[0]+'x'+options[0],
          href: options[1]
        }});
      links.push({
        hid: 'icon',
        rel: 'icon',
        type: 'image/png',
        sizes: '128x128',
        href: this.favicon['128']
      })
      return {
        link: links
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

    display: flex;
    justify-content: center;
    padding: 0 1.25rem;
    .z-image{
      padding: 0px 5px;
    }
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

.z-classic-menu{
  --button-font-size: 1rem;
  --button-height: 1.2rem;
  --button-color:#000;
  --dropdown-content-transform: translateY(2rem);
  display: flex;
  
  button{
    align-self: center;
  }
}
.z-districts,
.z-groups{
  --dropdown-content-transform: translateY(0);
}
.z-districts,
.z-classic-menu,
.z-groups {
  --button-color: var(--color-primary-darken);
  --list-item: 0;
  --link-hover-text-decoration: none;
  --dropdown-content-width: 160px;
  --dropdown-content-padding: 16px 0;
  

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
