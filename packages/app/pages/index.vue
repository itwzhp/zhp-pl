<template>
  <div id="home">
    <div class="hero-wrapper">
      <ZSection class="section-hero">
        <div class="section-hero__picture">
          <ZClipPath :hero-image="homepage._embedded['wp:featuredmedia'][0].media_details.sizes.medium_large.source_url" />
        </div>
        <ZHeading
          :level="1"
          class="section-hero__title t3"
        >
          Przygoda. Przyjaźń. Wychowanie.
        </ZHeading>
        <ZSearch
          class="section-hero__search"
          :input="{placeholder: 'Czego dzisiaj chcsz się dowiedzieć o ZHP?'}"
          @submit="search"
        />
      </ZSection>
    </div>
    <ZSection
      title="Polecamy"
    >
      <ZCarousel
        v-if="posts.length > 0"
        :peeked="true"
        :settings="{
          autoplay: 3000,
          breakpoints: {
            480: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="carousel"
      >
        <template v-for="post in posts">
          <li
            :key="post.id"
            class="glide__slide"
          >
            <ZPost
              :thumbnail="post.rest_media"
              :title="post.title.rendered"
              :to="`/aktualnosci/${post.slug}`"
              :author="post.rest_author"
              :date="post.date"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
    <ZSection class="section-highlighted">
      <ZCard
        v-if="cards['>>']"
        :title="cards['>>'].title.rendered"
        :thumbnail="cards['>>']._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url"
        :to="`/aktualnosci/${cards['>>'].slug}`"
        class="section-highlighted__card"
      />
      <ZHighlighted
        title="Aktualności"
        :posts="highlightedPosts"
        class="section-highlighted__posts"
      />
    </ZSection>
    <ZSection class="section-about-us">
      <ZBanner
        :thumbnail="{src: `${$config.mediaBaseURL}/wp-content/uploads/2020/11/Harcerskielatp2019.mp4`}"
        cover-type="video"
        title="Poznaj ZHP"
        content="Związek Harcerstwa Polskiego to największa organizacja harcerska w Polsce, która zrzesza ponad 100 000 osób! Koniecznie dowiedz się o niej więcej!"
        class="section-about-us__banner"
        :calls-to-action="[
          {name:'Odkryj harcerstwo', to: '/odkryj-harcerstwo'}
        ]"
      >
        <template #thumbnail="{thumbnail}">
          <ZVideo
            class="z-banner__thumbnail section-about-us__video"
            v-bind="thumbnail"
          />
        </template>
      </ZBanner>
    </ZSection>
    <ZSection class="section-join-us">
      <ZBanner
        :thumbnail="{src: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/Agnieszka_Madetko-Kurczab_ZHP_21-scaled.jpg'}"
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Harcerstwo to nie tylko niesamowita przygoda, ale także możliwość zdobycia sprawności na całe życie. Chcesz, aby Twoje dziecko wkroczyło z nami na szlak? Tutaj znajdziesz najważniejsze informacje."
        :calls-to-action="[
          {name:'No to zaczynamy', to: '/no-to-zaczynamy'},
          {name:'Ile kosztuje harcerstwo?', to: '/ile-kosztuje-harcerstwo'},
          {name:'Gdzie się zapisać?', to: '/gdzie-sie-zapisac'}]"
        class="section-join-us__banner"
      />
      <ZPost
        v-if="cards['>>>']"
        :title="cards['>>>'].title.rendered"
        :thumbnail="cards['>>>']._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url"
        :to="`/aktualnosci/${cards['>>>'].slug}`"
        :date="cards['>>>'].date"
        class="section-join-us__post"
      />
    </ZSection>
    <ZSection class="section-mission">
      <ZCard
        to="/stopnie-i-sprawnosci"
        title="Stopnie i sprawności"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/01.png"
        class="section-mission__card section-mission__card--first"
      />
      <ZCard
        to="/czlonkowie-organizacji"
        title="Członkowie organizacji"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/02.png"
        class="section-mission__card section-mission__card--bigger"
      />
      <ZCard
        title="Statut ZHP i Władze ZHP"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/03.png"
        class="section-mission__card"
      />
      <ZBanner
        title="Sprawdź Centralny Bank Pomysłów"
        content="Szukasz pomysłu na zbiórkę? Inspiracji do pracy z harcerzami?"
        :calls-to-action="{name: 'Przejdź do strony', to: 'http://cbp.zhp.pl/'}"
        class="section-mission__banner"
      />
    </ZSection>
    <ZSection
      class="section-events"
      title="Przedsięwzięcia i wydarzenia"
      subtitle=" Szukasz rajdu dla swojej drużyny? Albo konkursu dla swojej gromady? A&nbsp;może chcesz wziąć udział w&nbsp;kursie? Sprawdź, co odbywa się w&nbsp;ZHP w&nbsp;najbliższym czasie."
    >
      <ZCarousel
        v-if="events.length > 0"
        :peeked="true"
        :settings="{
          autoplay: 3000,
          breakpoints: {
            480: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="carousel"
      >
        <template v-for="event in events">
          <li
            :key="event.id"
            class="glide__slide"
          >
            <ZEvent
              :thumbnail="event.rest_media"
              :title="event.title && event.title.rendered"
              :to="`/wydarzenia/${event.slug}`"
              :author="event.rest_author"
              :date="event.rest_acf.date"
              :location="{name: event._embedded['wp:term'][0][0] && event._embedded['wp:term'][0][0].name, to:'#'}"
              :type="event.rest_event_type"
              :audiences="event.age_groups.map((ageGroup)=>(ageGroups[ageGroup]))"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
    <ZSection>
      <div style="grid-column: span 4;" />
      <div style="grid-column: span 3;">
        <ZFacebook />
      </div>
      <div style="grid-column: span 5;">
        <ZHeading>
          <ZLink
            to="/partnerzy"
            class="t4 uppercase"
            style="--link-text-decoration: none;"
          >
            Partnerzy organizacji
          </ZLink>
        </ZHeading>
        <ZCarousel
          :settings="{
            autoplay: 3000,
            perView: 3,
            peek: {
              before: 0,
              after: 55
            },
            breakpoints: {
              480: {
                perView: 1,
                peek: {
                  before: 0,
                  after: 20
                }
              }
            }
          }"
        >
          <template v-for="partner in partners">
            <li
              :key="partner.id"
              class="glide__slide"
            >
              <ZImage :src="partner.rest_media" />
            </li>
          </template>
        </ZCarousel>
        <ZImage :src="`${$config.mediaBaseURL}/wp-content/uploads/2020/11/ROHIS.png`" />
      </div>
    </ZSection>
  </div>
</template>

<script>
import {
  ZBanner,
  ZCard,
  ZCarousel,
  ZEvent,
  ZHeading,
  ZHighlighted,
  ZPost,
  ZSearch,
  ZSection,
  ZClipPath,
  ZVideo,
  ZImage,
  ZFacebook,
  ZLink
} from '@nowa-zhp/ui'
import { mapGetters } from 'vuex'

export default {
  components: {
    ZBanner,
    ZCard,
    ZCarousel,
    ZEvent,
    ZHeading,
    ZHighlighted,
    ZPost,
    ZSearch,
    ZSection,
    ZClipPath,
    ZVideo,
    ZImage,
    ZFacebook,
    ZLink
  },
  async asyncData ({ $axios }) {
    const homepageRes = await $axios.get('pages', { params: { slug: 'strona-glowna', _embed: true } })
    const homepage = homepageRes.data.shift()
    // last 8 post for posts ZCarousel
    const postsRes = await $axios.get('posts', { params: { per_page: 8, tags: 57, _embed: true } })
    const posts = postsRes.data
    // // last 5 posts for ZHighlighted component
    // const highlightedPostsRes = await $axios.get('posts', { params: { per_page: 5 } })
    // const highlightedPosts = highlightedPostsRes.data.map(post => ({ ...post, title: post.title.rendered }))
    // last 8 events for events ZCarousel
    const eventsRes = await $axios.get('events', { params: { per_page: 8, _embed: true } })
    const events = eventsRes.data
    // partners
    const partnersRes = await $axios.get('logos', { params: { per_page: 99, logos_categories: 25 } })
    const partners = partnersRes.data

    return { homepage, posts, events, partners }
  },
  computed: {
    ...mapGetters({
      cards: 'cards/posts'
    }),
    ageGroups () {
      return this.$store.getters['taxonomies/taxonomy']('age_groups')
    },
    highlightedPosts () {
      return this.$store.getters['posts/posts'].map(post => ({ ...post, title: post.title.rendered }))
    }
  },
  methods: {
    search (query) {
      this.$router.push({
        path: '/szukaj',
        query: { search: query }
      })
    }
  }
}
</script>

<style lang="scss">
#home {
  overflow: hidden;

  .hero-wrapper {
    max-width: 1360px;
    margin: 0 auto;
  }

  .section-hero {
    @media (min-width: 480px) {
      --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
      --section-content-max-width: 1235px;
      --section-content-margin: 0 auto 0 0;
    }

    &__picture {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 13;
        grid-row: span 2;
      }
    }

    &__title {
      margin: 0 0 1.5rem 0;
      grid-column: span 12;
      place-self: end stretch;

      @media (min-width: 480px) {
        grid-column: span 8;
      }
    }

    &__search {
      grid-column: span 12;
      place-self: start stretch;

      @media (min-width: 480px) {
        grid-column: span 11;
      }
    }
  }

  .section-highlighted {
    --section-content-align-items: center;

    &__card {
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

  .section-about-us {
    --section-content-max-width: 1235px;

    &__banner {
      grid-column: span 12;

      @media (min-width: 480px) {
        --banner-title-grid-column: span 5;
        --banner-description-grid-column: span 5;
        --banner-thumbnail-z-index: 10;
      }
    }
  }

  .section-join-us {
    &__banner {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 9;
      }
    }

    &__post {
      --post-grid-template-rows: 1fr auto;
      --post-meta-order: -1;

      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 3;
      }
    }
  }

  .section-mission {
    --section-content-align-items: end;

    @media (min-width: 480px) {
      --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
    }

    &__card {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 5;
      }

      &--bigger {
        overflow: hidden;

        @media (min-width: 480px) {
          height: calc(100% + 2rem);
          transform: translateY(16px);
        }
      }

      &--first {
        @media (min-width: 480px) {
          grid-column: 3 / span 5;
        }
      }
    }

    &__banner {
      --banner-description-grid-row: 1;
      --banner-description-grid-column: span 12;
      --banner-title-grid-row: 2;
      --banner-title-grid-column: span 12;
      --banner-title-margin: 0 0 2rem 0;
      --banner-title-font-size: var(--font-size-subtitle-1);
      --banner-title-text-transform: normal;
      --banner-cta-grid-column: span 12;

      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 5;
      }
    }
  }

  .section-events {
    @media (min-width: 480px) {
      --section-title-grid-column: span 3;
    }
  }

  .carousel {
    grid-column: span 12;
  }
}
</style>
