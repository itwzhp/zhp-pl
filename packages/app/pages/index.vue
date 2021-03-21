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
      :title="about.title"
      :subtitle="about.subtitle"
      class="section-about-us"
    >
      <template v-for="(tile, key) in about.tiles">
        <ZCard
          :key="key"
          :thumbnail="tile.thumbnail || placeholder"
          :title="tile.title"
          :description="tile.description"
          :to="tile.to"
          class="z-card--pictured z-card--overlayed section-about-us__tile"
        />
      </template>
    </ZSection>
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
        :thumbnail="{src: join.thumbnail}"
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
        v-if="joinUs"
        :title="joinUs.title.rendered"
        :thumbnail="joinUs._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url"
        :to="joinUs.rest_redirect ? joinUs.rest_redirect :`/${joinUs.date.split('-')[0]}/${joinUs.slug}`"
        :date="joinUs.date"
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
              :thumbnail="event.rest_media || placeholder"
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
    <ZSection
      v-if="partners.length > 0"
      class="section-partners"
      :title="partnersMeta.title"
    >
      <template #title>
        <ZHeading class="z-section__title">
          <ZLink
            :to="partnersMeta.to"
            class="t4 uppercase"
            style="--link-text-decoration: none;"
            v-html="partnersMeta.title"
          />
        </ZHeading>
      </template>
      <ZCarousel
        :has-controls="false"
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
        <template v-for="(partner, key) in partners">
          <li
            :key="key"
            class="glide__slide"
          >
            <ZImage
              :src="partner._embedded['wp:featuredmedia'][0].media_details.sizes.medium ? partner._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url : partner._embedded['wp:featuredmedia'][0].media_details.sizes.full.source_url"
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
  ZImage,
  ZCard,
  ZLink
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
    ZImage,
    ZCard,
    ZLink
  },
  async asyncData ({ $axios, store }) {
    const homepageRes = await $axios.get('pages', { params: { slug: 'strona-glowna', _embed: true } })
    const homepage = homepageRes.data.shift()
    const postsParams = { per_page: 25, _embed: true }
    if (homepage.rest_acf.posts.categories) {
      postsParams.categories = homepage.rest_acf.posts.categories
    }
    const postsRes = await $axios.get('posts', { params: postsParams })
    const posts = postsRes.data
    const eventsParams = { per_page: 25, _embed: true }
    if (homepage.rest_acf.events.categories) {
      eventsParams.event_categories = homepage.rest_acf.events.categories
    }
    const eventsRes = await $axios.get('events', { params: eventsParams })
    const events = eventsRes.data
    const joinUsParams = {
      per_page: 1,
      _embed: true
    }
    if (homepage.rest_acf.join.tags) {
      joinUsParams.tags = homepage.rest_acf.join.tags
    }
    const joinUsRes = await $axios.get('posts', { params: joinUsParams })
    const joinUs = joinUsRes.data.shift()
    const partnersParams = {
      per_page: 99,
      _embed: true
    }
    if (homepage.rest_acf.partners.categories) {
      partnersParams.logos_categories = homepage.rest_acf.partners.categories
    }
    const partnersRes = await $axios.get('logos', { params: partnersParams })
    const partners = partnersRes.data
    return { homepage, posts, events, partners, joinUs }
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
    about () {
      return this.homepage.rest_acf.about
    },
    join () {
      return this.homepage.rest_acf.join
    },
    partnersMeta () {
      return this.homepage.rest_acf.partners
    }
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
    &__tile {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 4;
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

  .section-events {
    @media (min-width: 640px) {
      --section-title-grid-column: span 3;
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

  .section-partners {
    &::before {
      content: none;
    }
  }
}
</style>
