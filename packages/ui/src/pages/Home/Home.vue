<template>
  <div id="home">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <div class="title">
        Przygoda.
        Przyjaźń.
        Wychowanie.
      </div>
      <!-- Czego dzisiaj chcesz się dowiedzieć o ZHP? ZSearch -->
      <form class="z-search search">
        <ZInput
          type="text"
          placeholder="Czego dzisiaj chcsz się dowiedzieć o ZHP?"
          class="z-search__input"
        />
        <ZButton
          style="--button-text-transform: uppercase;"
          class="z-search__submit"
        >
          <ZIcon
            name="search"
            class="z-search__icon"
          />
          Wyszukaj
        </ZButton>
      </form>
    </div>
    <!-- Aktualności -->
    <ZSection
      title="Aktualności"
      subtitle="Zobacz, co nowego w ZHP"
      style="margin: 90px auto;"
    >
      <ZCarousel v-if="posts.length > 0">
        <li
          v-for="post in posts"
          :key="post.id"
          class="glide__slide"
        >
          <ZArticle
            :key="post.id"
            :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${post.rest_media.file}`"
            :title="post.title.rendered"
            :to="post.link"
            :author="post.rest_author"
            :sticky="post.sticky"
            :date="post.date"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- Warto przeczytać -->
    <div
      style="display: grid;
max-width: 1120px;
align-items: center;
margin: 90px auto;
column-gap: 20px;
grid-template-columns: repeat(12, 1fr);"
    >
      <ZCard
        title="Polska reprezentacja na Jamboree 2019 w USA!"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        style=" height: 288px; grid-column: span 4; grid-template-rows: 1fr 96px;"
      />
      <div
        class="z-highlighted"
        style="grid-column: span 7;"
      >
        <div class="z-highlighted__header">
          <ZHeading
            class="z-highlighted__title"
            v-text="'Warto przeczytać'"
          />
          <ZLink
            to="#"
            class="z-highlighted__more z-highlighted__link"
            v-text="'Zobacz więcej'"
          />
        </div>
        <ZList>
          <template v-for="(item, key) in highlighted">
            <li
              :key="key"
              class="z-highlighted__item"
            >
              <ZLink
                to="#"
                v-text="item.title"
                class="z-highlighted__link"
              />
              <time
                :datetime="item.date"
                v-text="item.date"
              />
            </li>
          </template>
        </ZList>
      </div>
    </div>
    <!-- Poznaj ZHP -->
    <div
      style="display: grid;
      max-width: 1235px;
      margin: 90px auto;
      column-gap: 20px;
      grid-template-columns: repeat(12, 1fr);"
    >
      <ZBanner
        title="Poznaj ZHP"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        style="grid-column: span 12;"
      />
    </div>
    <!-- Chcesz zapisać swoje dziecko do harcerstwa -->
    <div
      style="display: grid;
      max-width: 1120px;
      margin: 90px auto;
      column-gap: 20px;
      grid-template-columns: repeat(12, 1fr);"
    >
      <ZBanner
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        :calls-to-action="[
          {name:'Jak zacząć', href: '#'},
          {name:'Ile kosztuje harcerstwo?', href: '#'},
          {name:'Gdzie się zapisać?', href: '#'}]"
        style="grid-column: span 9;"
      />
      <ZArticle
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="2020-08-30T08:30:31"
        style="grid-column: 10 / span 3; grid-template-rows: 1fr 128px; --article-meta-order: -1;"
      />
    </div>
    <!-- Stopnie i sprawności -->
    <div
      style="display: grid;
      max-width: 1120px;
      align-items: end;
      margin: 90px auto;
      column-gap: 20px;
      grid-template-columns: repeat(24, 1fr);"
    >
      <ZCard
        title="Stopnie i sprawności"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/01.png"
        class="z-card--uppercase"
        style="grid-column: 2 / span 5; grid-template-rows: 360px 1fr;"
      />
      <ZCard
        title="Piony metodyczne"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/02.png"
        class="z-card--uppercase"
        style="grid-column: span 5; grid-template-rows: 376px 96px; transform: translateY(16px);"
      />
      <ZCard
        title="Status ZHP i Władze ZHP"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/03.png"
        class="z-card--uppercase"
        style="grid-column: span 5; grid-template-rows: 360px 1fr;"
      />
      <!-- CTA / BANNER-->
      <ZBanner
        title="Sprawdź Strefę Instruktora"
        content="Szukasz pomysłu na zajęcia? Inspiracji do pracy z harcerzami?"
        :calls-to-action="{name: 'Przejdź do strony', href: '#'}"
        style="grid-column: span 5;

        --banner-title-margin: 0 0 32px 0;
        --banner-content-order: -1;
        --banner-title-font-size: 14px;
        --banner-title-text-transform: normal;"
      />
    </div>
    <!-- Wydarzenia -->
    <ZSection
      title="Wydarzenia i przedsięwzięcia"
      subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus sagittis,
      ultrices consectetur turpis."
      style="margin: 90px auto;"
    >
      <ZCarousel v-if="events.length > 0">
        <li
          v-for="event in events"
          :key="event.id"
          class="glide__slide"
        >
          <ZEvent
            :key="event.id"
            :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${event.rest_media.file}`"
            :title="event.title.rendered"
            :date="{start: '01/09/2020', end: '03/09/2020'}"
            :location="{name: 'Warszawa'}"
            :audience="{name: 'Wszyscy harcerze'}"
            :type="{name: 'Zlot'}"
            :age-group="{name: 'Harcerze Starsi', color: '#ffffff', background: '#084da1'}"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- Instagram, Facebook, Partnerzy -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <div
        class="instagram"
        style="grid-column: span 4;"
      >
        <ZHeading>#instagram</ZHeading>
      </div>
      <div
        class="facebook"
        style="grid-column: span 3;"
      >
        <ZHeading>facebook</ZHeading>
      </div>
      <div
        class="partners"
        style="grid-column: span 5;"
      >
        <ZHeading>Partnerzy organizacji</ZHeading>
        <ZCarousel
          v-if="partners.length > 0"
          :settings="{
            type: 'carousel',
            perView: 3,
            gap: 14,
            peek: { before: 0, after: 50 },
          }"
        >
          <li
            v-for="(partner, key) in partners"
            :key="key"
            class="glide__slide"
          >
            <ZImage
              :src="`https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/${partner}.png`"
            />
          </li>
        </ZCarousel>
        <ZHeading>Partnerzy wyjazdu na WSJ2019</ZHeading>
        <ZCarousel
          v-if="wsj2019Partners.length > 0"
          :settings="{
            type: 'carousel',
            perView: 3,
            gap: 14,
            peek: { before: 0, after: 50 },
          }"
        >
          <li
            v-for="(partner, key) in wsj2019Partners"
            :key="key"
            class="glide__slide"
          >
            <ZImage
              :src="`https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/${partner}.png`"
            />
          </li>
        </ZCarousel>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import {
  ZImage,
  ZSection,
  ZCarousel,
  ZArticle,
  ZEvent,
  ZCard,
  ZHeading,
  ZList,
  ZLink,
  ZBanner,
  ZButton,
  ZInput,
  ZIcon,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZButton,
    ZImage,
    ZSection,
    ZCarousel,
    ZArticle,
    ZEvent,
    ZCard,
    ZHeading,
    ZList,
    ZLink,
    ZBanner,
    ZInput,
    ZIcon,
  },
  data() {
    return {
      posts: [],
      events: [],
      highlighted: [
        { title: '400 harcerek i harcerzy wyruszyło do USA na Światowy Zlot Ska...', date: '18.07.2019' },
        { title: 'Oferty pracy w warszawskim biurze Europejskiego Jamboree 2020', date: '16.07.2019' },
        { title: 'Rekrutacja instruktorów do programu "Dobrze być sobą"', date: '16.07.2019' },
        { title: 'Bezpieczne #harcerskielato', date: '15.07.2019' },
        { title: 'Kielecki "Wiatraczek" znowu się kręci', date: '15.07.2019' },
      ],
      partners: ['greenpeace', 'wwf', 'mop', 'ufs'],
      wsj2019Partners: ['mbank', 'wsb', 'brand', 'pko'],
    };
  },
  async created() {
    const { API_URL } = process.env;
    const params = {
      per_page: 8,
    };
    const postsRes = await axios.get(`${API_URL}/posts`, { params });
    this.posts = postsRes.data;
    const eventsRes = await axios.get(`${API_URL}/events`, { params });
    this.events = eventsRes.data;
  },
};
</script>

<style lang="scss">
  #home {
    .title {
      margin: 24px 0;
      font-size: 50px;
      font-weight: 500;
      grid-column: 6 / span 4;
    }

    .search {
      grid-column: 6 / span 6;
      grid-row: 2;
    }
  }

  .z-highlighted {
    --link-text-decoration: underline;

    &__header {
      display: grid;
      align-items: center;
      justify-content: space-between;
      grid-template-columns: repeat(2, auto);
    }

    &__title {
      font-weight: 500;
      text-transform: uppercase;
    }

    &__more {
      color: #7ba22e;
    }

    &__item {
      display: grid;
      justify-content: space-between;
      margin: 16px 0;
      grid-template-columns: repeat(2, auto);
    }

    &__link {
      &:hover {
        --link-text-decoration: none;
      }
    }
  }

  .z-search {
    display: grid;
    grid-row-gap: 16px;
    justify-items: end;

    &__input {
      width: 100%;
    }

    &__icon {
      --icon-color: #fff;

      margin: 0 8px 0 0;
    }
  }

  .glide__slide {
    max-width: 248px;
  }
</style>
