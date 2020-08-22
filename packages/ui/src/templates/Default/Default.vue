<template>
  <div>
    <header>
      <ZButton>
        <ZIcon
          name="shuffle"
        /> Zmień serwis
      </ZButton>
      <ZLink to="/">
        <ZImage
          src="/assets/brand.svg"
          :sources="[{srcset: '/assets/brand.svg', src: '/assets/brand.svg'}]"
        />
      </ZLink>
      <div>
        <ZButton>
          Wyszukaj
        </ZButton>
        <ZButton>
          Język
        </ZButton>
        <ZButton>
          <ZIcon
            name="wheelchair"
          /> Zmień serwis
        </ZButton>
      </div>
      <nav>
        <ZLink
          v-for="(item, key) in headerNavigation"
          :key="key"
          :to="item.to"
        >
          {{ item.name }}
        </ZLink>
      </nav>
    </header>
    <footer>
      <div>
        <div>
          <ZHeading level="3">
            Czy wiesz, że...
          </ZHeading>
          <ZText>ZHP jest jedyną w Polsce organizacją skautową uznaną przez Światową Rodzinę Skautową i należy do WOSM i WAGGGS.</ZText>
        </div>
        <div>WOSM i WAGGGS</div>
      </div>
      <div>
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
      ZText,
      ZButton,
      ZIcon,
      ZLink,
      ZImage,
      ZHeading,
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
</style>
