<template>
  <div>
    <header class="z-header h-container">
      <ZButton class="z-button--pure">
        <ZIcon
          name="shuffle"
          style="--icon-color: #729634; margin: 0 1rem 0 0"
        /> Zmień serwis
      </ZButton>
      <ZLink to="/">
        <ZImage
          src="/assets/brand.svg"
          :sources="[{srcset: '/assets/brand.svg'}]"
          style="--image-height: 60px"
        />
      </ZLink>
      <div class="z-actions">
        <ZButton class="z-button--pure">
          Wyszukaj
        </ZButton>
        <ZButton class="z-button--pure">
          Język
        </ZButton>
        <ZButton class="z-button--pure">
          <ZIcon
            name="wheelchair"
            style="--icon-color: #729634; margin: 0 .5rem 0 0"
          /> Zmień serwis
        </ZButton>
      </div>
      <nav
        class="z-navigation"
        style="grid-row: 2; grid-column: 1 / span 3;"
      >
        <ZLink
          v-for="(item, key) in headerNavigation"
          :key="key"
          :to="item.to"
        >
          {{ item.name }}
        </ZLink>
      </nav>
    </header>
    <div id="home">
      content
    </div>
    <footer class="z-footer">
      <div class="h-container" style="display: grid; grid-auto-flow: column; column-gap: 1rem; justify-content: space-between; align-items: center;">
        <div>
          <ZHeading level="3">Czy wiesz, że...</ZHeading>
          <ZText>ZHP jest jedyną w Polsce organizacją skautową uznaną przez Światową Rodzinę Skautową i należy do WOSM i WAGGGS.</ZText>
        </div>
        <div>WOSM i WAGGGS</div>
      </div>
      <div class="h-container" style="display: grid; grid-auto-flow: column; column-gap: 1rem; justify-content: center; align-items: center;">
        <ZText>Copyright © 1997-2020 Związek Harcerstwa Polskiego</ZText>
        <nav class="z-navigation">
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
      ZText,
      ZButton,
      ZIcon,
      ZLink,
      ZImage,
      ZHeading
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
        ]
      }
    }
  }
</script>
<style lang="scss">
  .h-container {
    max-width: 1240px;
    margin: auto;
  }
  .z-header {
    display: grid;
    grid-auto-flow: column;
    justify-content: space-between;
    align-items: center;
    & > * {
      grid-row: 1;
    }
  }
  .z-actions {
    display: grid;
    grid-auto-flow: column;
    column-gap: 1rem;
  }
  .z-navigation {
    display: grid;
    grid-auto-flow: column;
    column-gap: 1rem;
    justify-content: center;
  }
  .z-footer {}
  #home {}
</style>
