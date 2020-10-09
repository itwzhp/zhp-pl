<template>
  <div id="home">
    <ZSection class="hero">
      <ZHeading
        :level="1"
        class="hero__title"
      >
        Przygoda.
        Przyjaźń.
        Wychowanie.
      </ZHeading>
      <!-- Czego dzisiaj chcesz się dowiedzieć o ZHP? ZSearch -->
      <form class="z-search hero__search">
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
          breakpoints: {
            480: {
              perView: 1
            }
          }
        }"
        class="z-carousel--peeked carousel"
      >
        <li
          v-for="post in posts"
          :key="post.id"
          class="glide__slide"
        >
          <ZPost
            :key="post.id"
            :thumbnail="post.rest_media"
            :title="post.title.rendered"
            :to="post.link"
            :author="post.rest_author"
            :sticky="post.sticky"
            :date="post.date"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <ZSection class="highlighted">
      <ZCard
        title="Polska reprezentacja na Jamboree 2019 w USA!"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        class="highlighted__post"
      />
      <ZHighlighted
        title="Warto przeczytać"
        :more="{title: 'Zobacz więcej', href: '#'}"
        :posts="highlighted"
        class="highlighted__posts"
      />
    </ZSection>
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
    <ZSection class="enjoy">
      <ZBanner
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        :calls-to-action="[
          {name:'Jak zacząć', href: '#'},
          {name:'Ile kosztuje harcerstwo?', href: '#'},
          {name:'Gdzie się zapisać?', href: '#'}]"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/Agnieszka_Madetko-Kurczab_ZHP_21-scaled.jpg"
        class="enjoy__banner"
      />
      <ZPost
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="2020-08-30T08:30:31"
        class="enjoy__post"
      />
    </ZSection>
    <ZSection
      class="instructor"
    >
      <ZCard
        title="Stopnie i sprawności"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/01.png"
        class="z-card--uppercase instructor__rank"
      />
      <ZCard
        title="Piony metodyczne"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/02.png"
        class="z-card--uppercase instructor__age-groups"
      />
      <ZCard
        title="Status ZHP i Władze ZHP"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/03.png"
        class="z-card--uppercase instructor__management"
      />
      <!-- CTA / BANNER-->
      <ZBanner
        title="Sprawdź Strefę Instruktora"
        content="Szukasz pomysłu na zajęcia? Inspiracji do pracy z harcerzami?"
        :calls-to-action="{name: 'Przejdź do strony', href: '#'}"
        class="instructor__zone"
      />
    </ZSection>
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
          breakpoints: {
            480: {
              perView: 1
            }
          }
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
            :thumbnail="event.rest_media"
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
    <ZSection class="social">
      <div
        class="social__instagram"
      >
        <ZHeading class="z-heading--uppercase">
          #instagram
        </ZHeading>
      </div>
      <div
        class="social__facebook"
      >
        <ZHeading class="z-heading--uppercase">
          facebook
        </ZHeading>
      </div>
      <div
        class="social__partners"
      >
        <ZHeading class="z-heading--uppercase">
          Partnerzy organizacji
        </ZHeading>
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
                :src="logo.rest_media"
              />
            </ZLink>
          </li>
        </ZCarousel>
        <ZHeading class="z-heading--uppercase">
          Partnerzy wyjazdu na WSJ2019
        </ZHeading>
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
                :src="logo.rest_media"
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
  ZPost,
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
    ZPost,
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

    const highlightedRes = await axios.get(`${API_URL}/posts`, { params: { per_page: 5 } });
    this.highlighted = highlightedRes.data.map((post) => ({ ...post, title: post.title.rendered }));

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

    .hero {
      &__title {
        margin: 24px 0;
        grid-column: span 12;

        @media (min-width: 480px) {
          grid-column: 6 / span 4;
          grid-row: 1;
        }
      }

      &__search {
        grid-column: span 12;

        @media (min-width: 480px) {
          grid-column: 6 / span 6;
          grid-row: 2;
        }
      }
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

    .highlighted {
      --section-content-align-items: center;

      &__post {
        grid-column: span 12;

        @media (min-width: 480px) {
          grid-column: span 4;
        }
      }

      &__posts {
        grid-column: span 12;

        @media (min-width: 480px) {
          grid-column: span 7;
        }
      }
    }

    .enjoy {
      &__banner {
        grid-column: span 12;

        @media (min-width: 480px) {
          grid-column: span 9;
        }
      }

      &__post {
        --post-grid-template-rows: 1fr auto;
        --article-meta-order: -1;

        grid-column: span 12;

        @media (min-width: 480px) {
          grid-column: span 3;
        }
      }
    }

    .instructor {
      --section-content-align-items: end;

      @media (min-width: 480px) {
        --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
      }

      &__rank,
      &__management,
      &__age-groups,
      &__zone {
        grid-column: span 12;

        @media (min-width: 480px) {
          grid-column: span 5;
        }
      }

      &__age-groups {
        @media (min-width: 480px) {
          height: calc(100% + 2rem);
          transform: translateY(16px);
        }
      }

      &__zone {
        --banner-title-margin: 0 0 32px 0;
        --banner-description-grid-row: 1;
        --banner-description-grid-column: span 12;
        --banner-title-grid-column: span 12;
        --banner-cta-grid-column: span 12;
        --banner-title-grid-row: 2;
        --banner-title-text-transform: normal;
        --banner-background: linear-gradient(135deg, rgba(123, 162, 46, 1) 8%, rgba(166, 206, 57, 1) 70%);
      }
    }

    .social {
      &__instagram,
      &__facebook,
      &__partners {
        grid-column: span 12;
      }

      &__instagram {
        @media (min-width: 480px) {
          grid-column: span 4;
        }
      }

      &__facebook {
        @media (min-width: 480px) {
          grid-column: span 3;
        }
      }

      &__partners {
        @media (min-width: 480px) {
          grid-column: span 5;
        }
      }
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
