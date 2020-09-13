<template>
  <div id="home">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <ZSection>
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
          style="--button-text-transform: uppercase; --button-min-width: 168px;"
          class="z-search__submit"
        >
          <ZIcon
            name="search"
            class="z-search__icon"
          />
          Wyszukaj
        </ZButton>
      </form>
    </ZSection>
    <!-- Aktualności -->
    <ZSection
      title="Aktualności"
      subtitle="Zobacz, co nowego w ZHP"
    >
      <ZCarousel
        v-if="posts.length > 0"
        :peeked="true"
        :settings="{
          type: 'carousel',
          perView: 4,
          gap: 20,
          autoplay: 3000,
        }"
        class="z-carousel--peeked carousel"
      >
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
    <ZSection class="highlighted">
      <ZCard
        title="Polska reprezentacja na Jamboree 2019 w USA!"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        style=" height: 288px; grid-column: span 4; grid-template-rows: 1fr 96px;"
      />
      <ZHighlighted
        style="grid-column: span 7;"
        title="Warto przeczytać"
        :more="{title: 'Zobacz więcej', href: '#'}"
        :articles="highlighted"
      />
    </ZSection>
    <!-- Poznaj ZHP -->
    <ZSection
      style="--section-content-max-width: 1235px;"
    >
      <ZBanner
        title="Poznaj ZHP"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        class="meet"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/news-DMB.png"
        cover-type="video"
      />
    </ZSection>
    <!-- Chcesz zapisać swoje dziecko do harcerstwa -->
    <ZSection>
      <ZBanner
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        :calls-to-action="[
          {name:'Jak zacząć', href: '#'},
          {name:'Ile kosztuje harcerstwo?', href: '#'},
          {name:'Gdzie się zapisać?', href: '#'}]"
        class="enjoy"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/Agnieszka_Madetko-Kurczab_ZHP_21-scaled.jpg"
      />
      <ZArticle
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="2020-08-30T08:30:31"
        style="grid-column: 10 / span 3; grid-template-rows: 1fr 128px; --article-meta-order: -1;"
      />
    </ZSection>
    <!-- Stopnie i sprawności -->
    <ZSection style="--section-content-grid-template-columns: repeat(24, 1fr); --section-content-align-items: end;">
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
        class="instructor-zone"
      />
    </ZSection>
    <!-- Wydarzenia -->
    <ZSection
      title="Wydarzenia i przedsięwzięcia"
      subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus sagittis,
      ultrices consectetur turpis."
    >
      <ZCarousel
        v-if="events.length > 0"
        :settings="{
          type: 'carousel',
          perView: 4,
          gap: 20,
          autoplay: 3000,
        }"
        :peeked="true"
        class="z-carousel--peeked carousel"
      >
        <li
          v-for="event in events"
          :key="event.id"
          class="glide__slide"
        >
          <ZEvent
            :key="event.id"
            :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${event.rest_media.file}`"
            :title="event.title.rendered"
            :date="event.rest_acf.date"
            :location="{name: 'Warszawa'}"
            :audience="{name: 'Wszyscy harcerze'}"
            :type="event.rest_event_type"
            :age-group="event.rest_age_group"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- Instagram, Facebook, Partnerzy -->
    <ZSection>
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
            autoplay: 2000,
          }"
        >
          <li
            v-for="(logo, key) in partners"
            :key="key"
            class="glide__slide"
          >
            <ZLink
              to="#"
            >
              <ZImage
                :src="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${logo.rest_media.file}`"
              />
            </ZLink>
          </li>
        </ZCarousel>
        <ZHeading>Partnerzy wyjazdu na WSJ2019</ZHeading>
        <ZCarousel
          v-if="wsj2019.length > 0"
          :settings="{
            type: 'carousel',
            perView: 3,
            gap: 14,
            peek: { before: 0, after: 50 },
            autoplay: 2000,
          }"
        >
          <li
            v-for="(logo, key) in wsj2019"
            :key="key"
            class="glide__slide"
          >
            <ZLink
              to="#"
            >
              <ZImage
                :src="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${logo.rest_media.file}`"
              />
            </ZLink>
          </li>
        </ZCarousel>
      </div>
    </ZSection>
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
  ZLink,
  ZBanner,
  ZButton,
  ZInput,
  ZIcon,
  ZHighlighted,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZHighlighted,
    ZButton,
    ZImage,
    ZSection,
    ZCarousel,
    ZArticle,
    ZEvent,
    ZCard,
    ZHeading,
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
        { title: '400 harcerek i harcerzy wyruszyło do USA na Światowy Zlot Ska...', date: '2019-07-15 00:00:00', href: '#' },
        { title: 'Oferty pracy w warszawskim biurze Europejskiego Jamboree 2020', date: '2019-07-16 00:00:00', href: '#' },
        { title: 'Rekrutacja instruktorów do programu "Dobrze być sobą"', date: '2019-07-16 00:00:00', href: '#' },
        { title: 'Bezpieczne #harcerskielato', date: '2019-07-16 00:00:00', href: '#' },
        { title: 'Kielecki "Wiatraczek" znowu się kręci', date: '2019-07-20 00:00:00', href: '#' },
      ],
      partners: [],
      wsj2019: [],
    };
  },
  async created() {
    const { API_URL } = process.env;
    let params = {
      per_page: 8,
    };

    const postsRes = await axios.get(`${API_URL}/posts`, { params });
    this.posts = postsRes.data;

    const eventsRes = await axios.get(`${API_URL}/events`, { params });
    this.events = eventsRes.data;

    params = {
      logo_categories: 27,
    };
    const logosPartnersRes = await axios.get(`${API_URL}/logos`, { params });
    this.partners = logosPartnersRes.data;

    params = {
      logo_categories: 28,
    };
    const logosWsj2019Res = await axios.get(`${API_URL}/logos`, { params });
    this.wsj2019 = logosWsj2019Res.data;
  },
};
</script>

<style lang="scss">
  #home {
    overflow: hidden;

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

    .carousel {
      grid-column: span 12;
    }

    .meet {
      --banner-content-padding: 64px;
      --banner-description-grid-column: span 5;
      --banner-title-grid-column: span 5;

      grid-column: span 12;
    }

    .enjoy {
      grid-column: span 9;
    }

    .instructor-zone {
      grid-column: span 5;

      --banner-title-margin: 0 0 32px 0;
      --banner-description-grid-row: 1;
      --banner-description-grid-column: span 12;
      --banner-title-grid-column: span 12;
      --banner-cta-grid-column: span 12;
      --banner-title-grid-row: 2;
      --banner-title-font-size: 14px;
      --banner-title-text-transform: normal;
      --banner-background: linear-gradient(135deg, rgba(123, 162, 46, 1) 8%, rgba(166, 206, 57, 1) 70%);
    }

    .highlighted {
      --section-content-align-items: center;
    }
  }

  .z-search {
    display: grid;
    grid-row-gap: 16px;
    justify-items: end;

    &__input {
      --input-background: #a6ce39;
      --input-color: #fff;

      width: 100%;
    }

    &__icon {
      --icon-color: #fff;

      margin: 0 8px 0 0;
    }
  }
</style>
