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
          <ZText>Drużynowi ZHP przepracowują społecznie łącznie 8 mln godzin w ciągu roku. Jeżeli przeliczyć to na złotówki, wartość pracy wolontariackiej wyniosłaby 136 mln zł.</ZText>
        </div>
        <div class="z-world-logos z-footer__world-logos">
          <ZLink to="https://www.wagggs.org/">
            <ZImage
              src="/assets/brand.svg"
              :sources="[{srcset: '/assets/wagggs.png', src: '/assets/wagggs.png'}]"
              class="z-worlds-logos__logo"
            />
          </ZLink>
          <ZLink to="https://www.scout.org/">
            <ZImage
              src="/assets/brand.svg"
              :sources="[{srcset: '/assets/wosm.png', src: '/assets/wosm.png'}]"
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
  import {ZButton, ZIcon, ZLink, ZImage, ZText, ZHeading} from "@nowa-zhp/ui"
  export default {
    name: "Home",
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
          {to: "#", name: "Strona Główna"},
          {to: "#", name: "Aktualności"},
          {to: "#", name: "Wydarzenia"},
          {to: "#", name: "Dla mediów"},
          {to: "#", name: "Dla rodzica"},
          {to: "#", name: "1% dla ZHP"},
          {to: "#", name: "Kontakt"}
        ],
        footerNavigation: [
          {to: "#", name: "Informacje i uwagi prawne"},
          {to: "#", name: "Polityka prywatności"},
          {to: "#", name: "Biuletyn Informacji Publicznej"},
          {to: "#", name: "RSS"}
        ],
      }
    }
  }
</script>
<style lang="scss">
.z-header {
  &__bar {
    display: grid;
    grid-template-columns: repeat(3, auto);
    justify-content: space-between;
    align-items: center;
    height: 80px;
  }
  &__actions {
    --button-color: #78a22f;
    --icon-color: #78a22f;
    --icon-margin: 0 1rem 0 0;
    display: grid;
    grid-template-columns: repeat(3, auto);
    align-items: center;
    grid-column-gap: .5rem;
  }
  &__navigation {
    display: grid;
    grid-template-columns: auto;
    justify-content: center;
    height: 48px;
  }
}
.z-logo {
  --image-width: 140px
}
.z-footer {
  background: #a6ce39;
  color: #ffffff;
  padding: 16px 0 0 0;
  &__content{
    display: grid;
    grid-template-columns: repeat(3, calc(100% / 3));
    align-items: center;
    height: 120px;
    background: #78a22f;
    color: #ffffff;
  }
  &__did-you-know {
    grid-column: span 1;
  }
  &__world-logos {
    grid-column: 3 / span 1;
  }
  &__bar {
    display: grid;
    align-items: center;
    grid-auto-flow: column;
    justify-content: center;
    height: 48px;
  }
}
.z-did-you-know {
  --heading-font-size: 12px;
  --text-font-size: 12px;
}
.z-world-logos {
  display: grid;
  grid-template-columns: repeat(2, auto);
  align-items: center;
  &__logo {
  }
}
</style>
