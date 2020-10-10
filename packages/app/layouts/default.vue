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
        <ZLink to="/">
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
        <nav class="z-menu z-header__menu">
          <template v-for="(item, key) in headerMenu">
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
    </header>
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
          Copyright © 1997-{{ year }} Związek Harcerstwa Polskiego
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
  }
}
</script>

<style lang="scss">
.z-header {
  overflow: hidden;

  &__bar {
    display: grid;
    align-items: center;
    grid-template-columns: repeat(3, auto);
    justify-content: space-between;
    padding: 0 1.25rem;
    height: 5rem;
  }

  &__actions {
    display: none;

    @media (min-width: 480px) {
      --icon-size: var(--font-size-button);
      --icon-margin: 0 1rem 0 0;
      --icon-color: var(--color-primary);
      --button-color: var(--color-primary);

      display: grid;
      grid-auto-flow: column;
      gap: 1rem;
    }
  }

  &__navigation {
    display: none;

    @media (min-width: 480px) {
      display: block;
    }
  }

  &__menu {
    height: 3rem;
  }
}

.z-footer {
  padding: 1rem 0 0 0;
  background: var(--color-primary-lighten);

  &__content {
    --section-margin: 0 auto;
    --section-background: var(--color-primary-darken);

    @media (min-width: 480px) {
      --section-margin: 0 auto;
    }
  }

  &__random-text {
    color: #fff;
    grid-column: span 12;
    margin: 1rem 0;

    @media (min-width: 480px) {
      --section-margin: 0 auto;

      grid-column: span 4;
      margin: 1.87rem 0;
    }
  }

  &__scouting {
    order: -1;
    display: grid;
    grid-column: span 12;
    margin: 1rem 0;

    @media (min-width: 480px) {
      margin: 0;
      order: 0;
      grid-auto-flow: column;
      grid-column: 9 / span 4;
    }
  }

  &__bar {
    display: grid;
    max-width: 1140px;
    padding: 1rem 1.25rem;
    color: #fff;
    margin: 0 auto;

    @media (min-width: 480px) {
      padding: 0 1.25rem;
      justify-content: center;
      align-items: center;
      grid-auto-flow: column;
      height: 3rem;
    }
  }
}

.z-menu {
  --link-font-size: var(--font-size-h6);

  display: grid;
  grid-auto-flow: row;
  align-items: center;
  gap: var(--menu-gap, 1.5rem);

  @media (min-width: 480px) {
    grid-auto-flow: column;
    justify-content: center;
  }

  &--secondary {
    --link-font-size: var(--font-size-subtitle-2);
    --menu-gap: 0;

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
