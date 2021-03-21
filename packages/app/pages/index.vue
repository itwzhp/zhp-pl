<template>
  <div id="home">
    <div class="hero-wrapper">
      <ZSection class="section-hero">
        <div
          class="section-hero__picture"
        >
          <div style="position: relative;">
            <ZClipPath :hero-image="homepage._embedded['wp:featuredmedia'][0].media_details.sizes.medium_large.source_url" />
            <div class="clip-path-logo">
              <ZImage
                :src="logo"
                :alt="title"
                class="clip-path-logo__image"
              />
            </div>
          </div>
        </div>
        <ZHeading
          :level="1"
          class="section-hero__title t3"
        >
          {{ title }}
        </ZHeading>
        <ZSearch
          class="section-hero__search"
          :input="{placeholder: 'Czego dzisiaj chcesz się dowiedzieć?'}"
          @submit="search"
        />
      </ZSection>
    </div>
    <ZSection
      v-if="posts.length > 0"
      title="Polecamy"
      class="section-posts"
    >
      <ZCarousel
        :peeked="true"
        :settings="{
          autoplay: 3000,
          breakpoints: {
            640: {
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
              :thumbnail="post.rest_media || placeholder"
              :title="post.title.rendered"
              :to="post.rest_redirect ? post.rest_redirect :`/${post.date.split('-')[0]}/${post.slug}`"
              :author="post.rest_author"
              :date="post.date"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
    <ZSection class="section-join-us">
      <ZBanner
        :thumbnail="{src: `${$config.mediaBaseURL}/wp-content/uploads/2020/12/Agnieszka_Madetko-Kurczab_ZHP.jpg`}"
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Harcerstwo to nie tylko niesamowita przygoda, ale także możliwość zdobycia sprawności na całe życie. Chcesz, aby Twoje dziecko wkroczyło z nami na szlak? Tutaj znajdziesz najważniejsze informacje."
        :calls-to-action="[
          {name:'No to zaczynamy', to: '/no-to-zaczynamy'},
          {name:'Ile kosztuje harcerstwo?', to: '/ile-kosztuje-harcerstwo'},
          {name:'Gdzie się zapisać?', to: '/gdzie-sie-zapisac'}]"
        class="section-join-us__banner"
      />
      <!-- TODO: add to theme_options join_us_post_category -->
      <ZPost
        v-if="cards['>>>']"
        :title="cards['>>>'].title.rendered"
        :thumbnail="cards['>>>']._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url"
        :to="cards['>>>'].rest_redirect ? cards['>>>'].rest_redirect :`/${cards['>>>'].date.split('-')[0]}/${cards['>>>'].slug}`"
        :date="cards['>>>'].date"
        class="section-join-us__post"
      />
    </ZSection>
    <ZSection
      class="section-events"
      title="Przedsięwzięcia i&nbsp;wydarzenia"
      subtitle="Szukasz rajdu dla swojej drużyny? Albo konkursu dla swojej gromady? A&nbsp;może chcesz wziąć udział w&nbsp;kursie? Sprawdź, co odbywa się w&nbsp;najbliższym czasie."
      :more="{name: 'wydarzenia'}"
    >
      <ZCarousel
        v-if="events.length > 0"
        :peeked="true"
        :settings="{
          autoplay: 3000,
          breakpoints: {
            640: {
              perView: 1,
              peek: {
                before: 20,
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
  </div>
</template>

<script>
import {
  ZBanner,
  ZCarousel,
  ZEvent,
  ZHeading,
  ZPost,
  ZSearch,
  ZSection,
  ZClipPath,
  ZImage
} from '@zhp-pl/ui'
import { mapGetters } from 'vuex'

export default {
  components: {
    ZBanner,
    ZCarousel,
    ZEvent,
    ZHeading,
    ZPost,
    ZSearch,
    ZSection,
    ZClipPath,
    ZImage
  },
  async asyncData ({ $axios, store }) {
    const homepageRes = await $axios.get('pages', { params: { slug: 'strona-glowna', _embed: true } })
    const homepage = homepageRes.data.shift()

    // TODO: add to ACF post_categories
    const postsRes = await $axios.get('posts', { params: { per_page: 25, _embed: true } })
    const posts = postsRes.data

    // TODO: add to ACF event_categories
    const eventsRes = await $axios.get('events', { params: { per_page: 25, _embed: true } })
    const events = eventsRes.data

    // TODO: add to ACF partners_categories
    const partnersRes = await $axios.get('logos', { params: { per_page: 99, logos_categories: 25, _embed: true } })
    const partners = partnersRes.data

    return { homepage, posts, events, partners }
  },
  computed: {
    ...mapGetters({
      cards: 'cards/posts',
      title: 'theme/title',
      logo: 'theme/logo',
      placeholder: 'theme/placeholder'
    }),
    ageGroups () {
      return this.$store.getters['taxonomies/taxonomy']('age_groups')
    },
  },
  methods: {
    search (query) {
      this.$router.push({
        path: '/szukaj',
        query: { search: query }
      })
    }
  },
  head () {
    const title = this.title
    const description = ''
    const image = this.placeholder
    return {
      title,
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: description
        },
        // Open Graph
        {
          hid: 'og:title',
          property: 'og:title',
          content: title
        },
        {
          hid: 'og:description',
          property: 'og:description',
          content: description
        },
        {
          hid: 'og:image',
          property: 'og:image',
          content: image
        },
        // Twitter Card
        {
          hid: 'twitter:title',
          property: 'twitter:title',
          content: title
        },
        {
          hid: 'twitter:description',
          property: 'twitter:description',
          content: description
        }
      ]
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
    @media (min-width: 640px) {
      --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
      --section-content-max-width: 1235px;
      --section-content-margin: 0 auto 0 0;
    }

    &__picture {
      margin: 0 0 44px 0;
      grid-column: span 12;

      @media (min-width: 640px) {
        margin: 0;
        grid-column: span 13;
        grid-row: span 2;
      }
    }

    &__title {
      margin: 0 0 1.5rem 0;
      grid-column: span 12;
      place-self: end stretch;

      @media (min-width: 640px) {
        grid-column: span 9;
      }
    }

    &__search {
      grid-column: span 12;
      place-self: start stretch;

      @media (min-width: 640px) {
        grid-column: span 11;
      }
    }
  }

  .section-highlighted {
    --section-content-align-items: center;

    &__card {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 4;
      }
    }

    &__posts {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 7;
      }
    }
  }

  .section-about-us {
    --section-content-max-width: 1235px;

    &__banner {
      grid-column: span 12;

      @media (min-width: 640px) {
        --banner-title-grid-column: span 5;
        --banner-description-grid-column: span 5;
        --banner-thumbnail-z-index: 10;
      }
    }
  }

  .section-join-us {
    &__banner {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 9;
      }
    }

    &__post {
      --post-grid-template-rows: 1fr auto;
      --post-meta-order: -1;

      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 3;
      }
    }
  }

  .section-mission {
    --section-content-align-items: end;

    @media (min-width: 640px) {
      --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
    }

    &__card {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 5;
      }

      &--bigger {
        overflow: hidden;

        @media (min-width: 640px) {
          height: calc(100% + 2rem);
          transform: translateY(16px);
        }
      }

      &--first {
        @media (min-width: 640px) {
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

      @media (min-width: 640px) {
        grid-column: span 5;
      }
    }
  }

  .section-events {
    @media (min-width: 640px) {
      --section-title-grid-column: span 3;
    }
  }

  .section-social {
    &__instagram {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 4;
      }
    }

    &__facebook {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 3;
      }
    }

    &__partners {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 5;
      }
    }
  }

  .carousel {
    grid-column: span 12;
  }

  .section-posts {
    --section-content-max-width: 1100px;
  }

  .clip-path-logo {
    position: absolute;
    z-index: 1;
    bottom: -25px;
    width: 30%;
    padding-top: 30%;
    background: #fff;
    border-radius: 100%;
    box-shadow: 5px 10px 20px 0 rgba(0, 0, 0, 0.16);

    &__image {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      padding: 10%;
    }
  }
}
</style>
