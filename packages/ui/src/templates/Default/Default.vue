<template>
  <div>
    <header class="z-header">
      <div class="z-header__bar">
        <div class="z-header__actions">
          <ZButton class="z-button--text">
            <ZIcon
              name="shuffle"
            /> Zmień serwis
          </ZButton>
        </div>
        <ZLink to="/">
          <ZImage
            src="/assets/brand.svg"
            :sources="[{srcset: '/assets/brand.svg', src: '/assets/brand.svg'}]"
            class="z-logo"
          />
        </ZLink>
        <div class="z-header__actions">
          <ZButton class="z-button--text">
            Wyszukaj
          </ZButton>
          <ZButton class="z-button--text">
            Język
          </ZButton>
          <ZButton class="z-button--text">
            <ZIcon
              name="wheelchair"
            /> Zmień serwis
          </ZButton>
        </div>
      </div>
      <div class="z-header__navigation">
        <nav>
          <ZLink
            v-for="(item, key) in headerNavigation"
            :key="key"
            :to="item.to"
          >
            {{ item.name }}
          </ZLink>
        </nav>
      </div>
    </header>
    <footer class="z-footer">
      <div class="z-footer__content">
        <div class="z-did-you-know z-footer__did-you-know">
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
      <div class="z-footer__bar">
        <ZText>Copyright © 1997-2020 Związek Harcerstwa Polskiego</ZText>
        <nav>
          <ZLink
            v-for="(item, key) in footerNavigation"
            :key="key"
            :to="item.to"
          >
            {{ item.name }}
          </ZLink>
        </nav>
      </div>
    </footer>
  </div>
</template>
<script>
import {
  ZButton, ZIcon, ZLink, ZImage, ZText, ZHeading,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZHeading,
    ZText,
    ZButton,
    ZIcon,
    ZLink,
    ZImage,
  },
  data() {
    return {
      headerNavigation: [
        { to: '#', name: 'Strona Główna' },
        { to: '#', name: 'Aktualności' },
        { to: '#', name: 'Wydarzenia' },
        { to: '#', name: 'Dla mediów' },
        { to: '#', name: 'Dla rodzica' },
        { to: '#', name: '1% dla ZHP' },
        { to: '#', name: 'Kontakt' },
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
  &__bar {
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
    justify-content: center;
    grid-template-columns: auto;
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
    height: 120px;
    align-items: center;
    background: #78a22f;
    color: #fff;
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
    height: 48px;
    align-items: center;
    justify-content: center;
    grid-auto-flow: column;
  }
}

.z-did-you-know {
  --heading-font-size: 12px;
  --text-font-size: 12px;
}

.z-world-logos {
  display: grid;
  align-items: center;
  grid-template-columns: repeat(2, auto);

  &__logo {
  }
}
</style>
