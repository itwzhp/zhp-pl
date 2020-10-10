<template>
  <div>
    <header class="z-header">
      <div class="z-header__bar">
        <div class="z-header__actions">
          <ZDropdown class="z-header__mega-menu">
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
        <ZLink to="/">
          <ZImage
            :src="require('~/assets/brand.svg')"
            class="z-logo"
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
          <ZDropdown class="z-dropdown--has-chevron">
            <template #toggle="{toggle}">
              <ZButton
                class="z-button--text z-dropdown__toggle"
                style="--button-color: #78a22f;"
                @click="toggle"
              >
                Język
              </ZButton>
            </template>
          </ZDropdown>
          <ZDropdown class="z-header__mega-menu">
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
        <nav>
          <ZList class="z-navigation">
            <template v-for="(item, key) in headerMenu">
              <li
                :key="key"
                class="z-navigation__item"
              >
                <ZLink
                  :to="item.to"
                  class="z-navigation__link"
                >
                  {{ item.name }}
                </ZLink>
              </li>
            </template>
          </ZList>
        </nav>
      </div>
    </header>
    <Nuxt />
    <footer class="z-footer">
      <ZSection
        class="z-footer__content"
        style="--section-margin: 0 auto;"
      >
        <ZDidYouKnow :random-text="randomText" class="z-footer__did-you-know" />
        <div class="z-world-logos z-footer__world-logos">
          <ZLink to="https://www.wagggs.org/">
            <ZImage
              :src="require('~/assets/wagggs.png')"
              class="z-worlds-logos__logo"
            />
          </ZLink>
          <ZLink to="https://www.scout.org/">
            <ZImage
              :src="require('~/assets/wosm.png')"
              class="z-worlds-logos__logo"
            />
          </ZLink>
        </div>
      </ZSection>
      <div class="z-footer__bar">
        <ZText>Copyright © 1997-2020 Związek Harcerstwa Polskiego</ZText>
        <nav class="z-footer__navigation">
          <ZList class="z-navigation z-navigation--secondary">
            <template v-for="(item, key) in footerMenu">
              <li
                :key="key"
                class="z-navigation__item"
              >
                <ZLink
                  :to="item.to"
                  class="z-navigation__link"
                >
                  {{ item.name }}
                </ZLink>
              </li>
            </template>
          </ZList>
        </nav>
      </div>
    </footer>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import {
  ZDropdown,
  ZText,
  ZButton,
  ZIcon,
  ZLink,
  ZImage,
  ZList,
  ZSection,
  ZDidYouKnow
} from '@nowa-zhp/ui'

export default {
  name: 'Default',
  components: {
    ZDropdown,
    ZText,
    ZButton,
    ZIcon,
    ZLink,
    ZImage,
    ZList,
    ZSection,
    ZDidYouKnow
  },
  async middleware ({ store, $axios }) {
    // story is required to get data on server-side
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
    const randomTextRes = await $axios.get('random')
    const randomText = randomTextRes.data
    store.commit('random/update', randomText.text)
  },
  computed: {
    ...mapGetters({ headerMenu: 'menus/headerMenu', footerMenu: 'menus/footerMenu', randomText: 'random/text' })
  }
}
</script>

<style lang="scss">
// other
.z-header {
  padding: 0 20px;

  &__bar {
    position: relative;
    display: grid;
    height: 80px;
    align-items: center;
    justify-content: space-between;
    grid-template-columns: repeat(3, auto);
  }

  &__actions {
    --button-color: #78a22f;
    --icon-color: #78a22f;
    --icon-margin: 0 1rem 0 0;

    display: grid;
    align-items: center;
    grid-column-gap: 0.5rem;
    grid-template-columns: repeat(3, auto);
  }

  &__navigation {
    display: grid;
    height: 48px;
    align-items: center;
    justify-content: center;
    grid-template-columns: auto;
  }

  &__mega-menu {
    --dropdown-content-top: 100%;
    --dropdown-content-margin: 0 0 0 -20px;
    --dropdown-content-width: 100vw;

    position: static;
  }
}

.z-logo {
  --image-width: 140px;
}

.z-footer {
  padding: 16px 0 0 0;
  background: #a6ce39;
  color: #fff;

  &__content {
    --section-margin: 0 auto;
    --section-background: #78a22f;
    --section-content-height: 120px;
    --section-content-align-items: center;
  }

  &__did-you-know {
    grid-column: span 4;
  }

  &__world-logos {
    grid-column: 9 / span 4;
  }

  &__bar {
    display: grid;
    max-width: 1120px;
    height: 48px;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    grid-auto-flow: column;
  }

  &__navigation {
    margin: 0 0 0 4px;
  }
}

.z-world-logos {
  display: grid;
  align-items: center;
  grid-template-columns: repeat(2, auto);
}

.z-navigation {
  $this: &;

  display: grid;
  align-items: center;
  column-gap: 24px;
  grid-auto-flow: column;

  &__link {
    position: relative;
    border-width: 0 0 2px 0;
    border-style: solid;
    border-color: transparent;
    transition: border-color 150ms ease-in-out;

    &:hover {
      --link-text-decoration: none;

      border-color: #1e152f;
    }
  }

  &--secondary {
    column-gap: 4px;

    #{$this}__link {
      border-width: 0;

      &:hover {
        --link-text-decoration: underline;
      }

      &::before {
        margin: 0 4px 0 0;
        content: "|";
      }
    }
  }
}
</style>
