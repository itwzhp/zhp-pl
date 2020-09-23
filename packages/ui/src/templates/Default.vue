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
            src="/assets/brand.svg"
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
            <template v-for="(item, key) in headerNavigation">
              <li
                :key="key"
                class="z-navigation__item"
              >
                <ZLink
                  :to="item.to"
                  class="z-navigation__link"
                  v-text="item.name"
                />
              </li>
            </template>
          </ZList>
        </nav>
      </div>
    </header>
    <slot v-bind="{component}" />
    <footer class="z-footer">
      <div style="background: #78a22f; color: #fff;">
        <div class="z-footer__content">
          <div class="z-did-you-know z-footer__did-you-know">
            <ZIcon
              name="question-marks"
              class="z-did-you-know__question-marks"
            />
            <ZHeading
              level="3"
              class="z-heading--uppercase z-did-you-know__title"
            >
              Czy wiesz że...
            </ZHeading>
            <ZText>
              Drużynowi ZHP przepracowują społecznie łącznie 8 mln godzin w ciągu roku.
              Jeżeli przeliczyć to na złotówki, wartość pracy wolontariackiej wyniosłaby 136 mln zł.
            </ZText>
          </div>
          <div class="z-world-logos z-footer__world-logos">
            <ZLink to="https://www.wagggs.org/">
              <ZImage
                src="/assets/brand.svg"
                :sources="[
                  {
                    srcset: '/assets/wagggs.png',
                    src: '/assets/wagggs.png'
                  }
                ]"
                class="z-worlds-logos__logo"
              />
            </ZLink>
            <ZLink to="https://www.scout.org/">
              <ZImage
                src="/assets/brand.svg"
                :sources="[
                  {
                    srcset: '/assets/wosm.png',
                    src: '/assets/wosm.png'
                  }
                ]"
                class="z-worlds-logos__logo"
              />
            </ZLink>
          </div>
        </div>
      </div>
      <div class="z-footer__bar">
        <ZText v-text="'Copyright © 1997-2020 Związek Harcerstwa Polskiego'" />
        <nav class="z-footer__navigation">
          <ZList class="z-navigation z-navigation--secondary">
            <template v-for="(item, key) in footerNavigation">
              <li
                :key="key"
                class="z-navigation__item"
              >
                <ZLink
                  :to="item.to"
                  class="z-navigation__link"
                  v-text="item.name"
                />
              </li>
            </template>
          </ZList>
        </nav>
      </div>
    </footer>
  </div>
</template>
<script>
import {
  ZDropdown,
  ZHeading,
  ZText,
  ZButton,
  ZIcon,
  ZLink,
  ZImage,
  ZList,
} from '../../index';

export default {
  name: 'Default',
  components: {
    ZDropdown,
    ZHeading,
    ZText,
    ZButton,
    ZIcon,
    ZLink,
    ZImage,
    ZList,
  },
  data() {
    return {
      component: 'home',
      headerNavigation: [
        { to: 'home', name: 'Strona Główna' },
        { to: 'Posts', name: 'Aktualności' },
        { to: 'events', name: 'Wydarzenia' },
        { to: 'home', name: 'Dla mediów' },
        { to: 'home', name: 'Dla rodzica' },
        { to: 'home', name: '1% dla ZHP' },
        { to: 'home', name: 'Kontakt' },
      ],
      footerNavigation: [
        { to: '#', name: 'Informacje i uwagi prawne' },
        { to: '#', name: 'Polityka prywatności' },
        { to: '#', name: 'Biuletyn Informacji Publicznej' },
        { to: '#', name: 'RSS' },
      ],
    };
  },
};
</script>
<style lang="scss">
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
    display: grid;
    max-width: 1120px;
    height: 120px;
    align-items: center;
    margin: 0 auto;
    grid-template-columns: repeat(3, calc(100% / 3));
  }

  &__did-you-know {
    grid-column: span 1;
  }

  &__world-logos {
    grid-column: 3 / span 1;
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

.z-did-you-know {
  --heading-font-size: 12px;
  --text-font-size: 12px;

  position: relative;

  & > * {
    position: relative;
    z-index: 1;
  }

  &__question-marks {
    --icon-size: 100px;

    position: absolute;
    z-index: 0;
    top: 0;
    left: 0;
    fill: #4a7b26;
    opacity: 0.4;
    transform: translate(-66%, -34%);
  }
}

.z-world-logos {
  display: grid;
  align-items: center;
  grid-template-columns: repeat(2, auto);

  &__logo {
  }
}

.z-navigation {
  $this: &;

  display: grid;
  align-items: center;
  column-gap: 24px;
  font-size: 18px;
  font-weight: 500;
  grid-auto-flow: column;
  line-height: 1;

  &__link {
    position: relative;
    border-width: 0 0 2px 0;
    border-style: solid;
    border-color: transparent;
    line-height: 0;
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
      font-size: 14px;

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
