<template>
  <div>
    <header class="z-header">
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
      <!-- aktualności -->
      <ZSection
        title="Aktualności"
        subtitle="Zobacz, co nowego w ZHP"
      >
        <ZCarousel>
          <li
            v-for="(post, key) in posts"
            :key="key"
            class="glide__slide"
          >
            <ZCard
              :title="post.title"
              :author="post.author"
              :date="post.date"
              :to-link="post.toLink"
              :src-image="post.srcImage"
              :sources-image="post.sourcesImage"
            />
          </li>
        </ZCarousel>
      </ZSection>
      <!-- poznaj -->
      <ZSection>
        <ZBanner
          title="Poznaj ZHP"
          content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempus euismod libero, et varius lorem rutrum ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi in nibh luctus, fermentum arcu sit amet, tincidunt nisl. Maecenas malesuada nisl eu elit dignissim, et tempor odio feugiat."
        >
          <template #thumb>
            <ZVideo
              autoplay
              loop
              :sources="[
                {
                  src: 'https://watra.zhp.pl/media/wdesktop.842e12d8.mp4'
                }
              ]"
            />
          </template>
        </ZBanner>
      </ZSection>
      <!-- zapisz -->
      <ZSection>
        <div style="max-width:1070px; margin: auto; display: grid; grid-template-columns: 1fr 250px; column-gap: 30px">
          <ZBanner
            title="Chcesz zapisać swoje dziecko do harcerstwa?"
            content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempus euismod libero, et varius lorem rutrum ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi in nibh luctus, fermentum arcu sit amet, tincidunt nisl. Maecenas malesuada nisl eu elit dignissim, et tempor odio feugiat."
            :call-to-actions="[{name: 'Jak zacząć?', to: '#'}, {name: 'Ile kosztuje harcerstwo?', to: '#'}, {name: 'Gdzie zacząć?', to: '#'}]"
            src-image="https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png"
            :sources-image="[
              {
                srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png',
                media: '(min-width: 480px)',
                type: 'image/png'
              },
              {
                srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png'
              }
            ]"
          />
          <ZCard
            title="Przewodnicząca ZHP i Naczelnik ZHP: Wychowujemy w zgodzie z wartościami"
            src-image="https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png"
            :sources-image="[
              {
                srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png',
                media: '(min-width: 480px)',
                type: 'image/png'
              },
              {
                srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png'
              }
            ]"
          />
        </div>
      </ZSection>
      <!-- stopnie i sprawności | pion metodyczny | statut i władze zhp | przejdź do strony -->
      <!-- wydarzenia i przedsięwzięcia-->
      <ZSection
        title="Wydarzenia i przedsięwzięcia"
        subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempus euismod libero, et varius lorem rutrum ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. "
      >
        <ZCarousel>
          <li
            v-for="(post, key) in posts"
            :key="key"
            class="glide__slide"
          >
            <ZCard
              :title="post.title"
              :author="post.author"
              :date="post.date"
              :to-link="post.toLink"
              :src-image="post.srcImage"
              :sources-image="post.sourcesImage"
            />
          </li>
        </ZCarousel>
      </ZSection>
      <!-- #Instagram | Facebook | Partenrzy organizacji | Partnerzy wyjazdu na WSJ2019 -->
    </div>
    <footer class="z-footer">
      <div
        style="display: grid; grid-auto-flow: column; column-gap: 1rem; justify-content: space-between; align-items: center;"
      >
        <div>
          <ZHeading level="3">
            Czy wiesz, że...
          </ZHeading>
          <ZText>ZHP jest jedyną w Polsce organizacją skautową uznaną przez Światową Rodzinę Skautową i należy do WOSM i WAGGGS.</ZText>
        </div>
        <div>WOSM i WAGGGS</div>
      </div>
      <div
        style="display: grid; grid-auto-flow: column; column-gap: 1rem; justify-content: center; align-items: center;"
      >
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
  import {ZButton, ZIcon, ZLink, ZImage, ZVideo, ZText, ZHeading, ZSection, ZCarousel, ZCard, ZBanner } from "@nowa-zhp/ui"
  export default {
    name: "Home",
    components: {
      ZCard,
      ZText,
      ZButton,
      ZIcon,
      ZLink,
      ZImage,
      ZVideo,
      ZHeading,
      ZSection,
      ZCarousel,
      ZBanner
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
        posts: [
          {
            srcImage: "https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg",
            sourcesImage: [{srcset:"https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg"}],
            toLink: "#",
            title: "Szkolenie z RODO dla komisji rewizyjnych",
            author: {name: "Marta Jeżak", to:"#"},
            date: "14.05.2020"
          },
          {
              srcImage: "https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg",
              sourcesImage: [{srcset:"https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg"}],
              toLink: "#",
              title: "Szkolenie z RODO dla komisji rewizyjnych",
              author: {name: "Marta Jeżak", to:"#"},
              date: "14.05.2020"
          },
          {
              srcImage: "https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg",
              sourcesImage: [{srcset:"https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg"}],
              toLink: "#",
              title: "Szkolenie z RODO dla komisji rewizyjnych",
              author: {name: "Marta Jeżak", to:"#"},
              date: "14.05.2020"
          },
          {
              srcImage: "https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg",
              sourcesImage: [{srcset:"https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg"}],
              toLink: "#",
              title: "Szkolenie z RODO dla komisji rewizyjnych",
              author: {name: "Marta Jeżak", to:"#"},
              date: "14.05.2020"
          }
        ]
      }
    }
  }
</script>
<style lang="scss">
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
