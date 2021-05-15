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
          ZHP - sprawności na&nbsp;całe życie
        </ZHeading>
        <ZSearch
          class="section-hero__search"
          :input="{placeholder: 'Czego dzisiaj chcesz dowiedzieć się o ZHP?'}"
          @submit="search"
        />
      </ZSection>
    </div>
    <ZSection
      title="Polecamy"
      class="section-posts"
    >
      <ZCarousel
        v-if="posts.length > 0"
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
              :thumbnail="post.rest_media || require('~/assets/placeholder.png')"
              :title="post.title.rendered"
              :to="post.rest_redirect ? post.rest_redirect :`/${post.date.split('-')[0]}/${post.slug}`"
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
        :to="cards['>>'].rest_redirect ? cards['>>'].rest_redirect :`/${cards['>>'].date.split('-')[0]}/${cards['>>'].slug}`"
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
        :calls-to-action="[]"
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
        :thumbnail="{src: `${$config.mediaBaseURL}/wp-content/uploads/2020/12/Agnieszka_Madetko-Kurczab_ZHP.jpg`}"
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
        :to="cards['>>>'].rest_redirect ? cards['>>>'].rest_redirect :`/${cards['>>>'].date.split('-')[0]}/${cards['>>>'].slug}`"
        :date="cards['>>>'].date"
        class="section-join-us__post"
      />
    </ZSection>
    <ZSection class="section-mission">
      <ZCard
        to="/stopnie-i-sprawnosci"
        title="Stopnie i sprawności"
        :thumbnail="`${$config.mediaBaseURL}/wp-content/uploads/2020/12/01.png`"
        class="section-mission__card section-mission__card--first"
      />
      <ZCard
        to="/czlonkowie-organizacji"
        title="Członkowie organizacji"
        :thumbnail="`${$config.mediaBaseURL}/wp-content/uploads/2020/12/02.png`"
        class="section-mission__card section-mission__card--bigger"
      />
      <ZCard
        title="Statut ZHP i Władze ZHP"
        :thumbnail="`${$config.mediaBaseURL}/wp-content/uploads/2020/12/03.png`"
        class="section-mission__card"
        to="/organizacja"
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
      title="Przedsięwzięcia i&nbsp;wydarzenia"
      subtitle="Szukasz rajdu dla swojej drużyny? Albo konkursu dla swojej gromady? A&nbsp;może chcesz wziąć udział w&nbsp;kursie? Sprawdź, co odbywa się w&nbsp;ZHP w&nbsp;najbliższym czasie."
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
    <ZSection class="section-social">
      <div class="section-social__instagram">
        <ZInstagram
          :image="`${$config.mediaBaseURL}/wp-content/uploads/2020/11/instagram.jpg`"
          :feed="feed"
          name="Związek Harcerstwa Polskiego"
          user="zhp_pl"
          :description="instagramDescription"
        />
      </div>
      <div class="section-social__facebook">
        <ZFacebook
          app-id="2797653613806518"
          fb-page-url="https://www.facebook.com/ZHPpl"
        />
      </div>
      <div class="section-social__partners">
        <ZHeading>
          <ZLink
            to="/partnerzy"
            class="t4 uppercase"
            style="--link-text-decoration: none;"
          >
            Partnerzy organizacji
          </ZLink>
        </ZHeading>
        <ZSection
          tag="div"
          style="--section-margin: 0;"
        >
          <ZCarousel
            class="carousel"
            :has-controls="false"
            :settings="{
              autoplay: 3000,
              perView: 3,
              peek: {
                before: 0,
                after: 55
              },
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
          >
            <template v-for="partner in partners">
              <li
                :key="partner.id"
                class="glide__slide"
              >
                <ZImage
                  :src="partner._embedded['wp:featuredmedia'][0].media_details.sizes.medium ? partner._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url : partner._embedded['wp:featuredmedia'][0].media_details.sizes.full.source_url"
                />
              </li>
            </template>
          </ZCarousel>
        </ZSection>
        <ZImage
          :src="`${$config.mediaBaseURL}/wp-content/uploads/2020/11/ROHIS.png`"
        />
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
  ZLink,
  ZInstagram
} from '@zhp-pl/ui'
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
    ZLink,
    ZInstagram
  },
  async asyncData ({ $axios, store }) {
    const homepageRes = await $axios.get('pages', { params: { slug: 'strona-glowna', _embed: true } })
    const homepage = homepageRes.data.shift()
    // last 8 post for posts ZCarousel
    const postsParams = {
      per_page: 25,
      _embed: true,
      tags: 432 // Polecane
    }
    const postsRes = await $axios.get('posts', { params: postsParams })
    const posts = postsRes.data
    // // last 5 posts for ZHighlighted component
    // const highlightedPostsRes = await $axios.get('posts', { params: { per_page: 5 } })
    // const highlightedPosts = highlightedPostsRes.data.map(post => ({ ...post, title: post.title.rendered }))
    // last 8 events for events ZCarousel
    const eventsParams = {
      per_page: 25,
      _embed: true
    }
    if (homepage.rest_acf.event_categories) {
      eventsParams.event_categories = homepage.rest_acf.event_categories
    }
    const eventsRes = await $axios.get('events', { params: eventsParams })
    const events = eventsRes.data
    // partners
    const partnersRes = await $axios.get('logos', { params: { per_page: 99, logos_categories: 25, _embed: true } })
    const partners = partnersRes.data

    if (!Object.keys(store.state.instagram.posts).length) {
      const instagramRes = await $axios.get('instagram')
      const instagram = instagramRes.data
      const feed = instagram.match(/href="(.+?)".+?data-full-res="(.+?)"/gm).map(match => (
        { href: match.match(/href="(.+?)"/)[1], src: match.match(/data-full-res="(.+?)"/)[1] }
      ))
      store.commit('instagram/update', feed)
    }

    return { homepage, posts, events, partners }
  },
  computed: {
    ...mapGetters({
      cards: 'cards/posts'
    }),
    ageGroups () {
      return this.$store.getters['taxonomies/taxonomy']('age_groups')
    },
    feed () {
      return this.$store.getters['instagram/posts']
    },
    highlightedPosts () {
      return this.$store.getters['posts/posts'].map(post => ({ ...post, title: post.title.rendered })).slice(0, 5)
    },
    instagramDescription () {
      return `⚜️ Największa organizacja harcerska w Polsce <a
            class="z-link"
            href="https://www.instagram.com/explore/tags/zhp/"
            target="_blank"
          >
            #ZHP
          </a>| The Polish Scouting and Guiding Association official | <a
            class="z-link"
            href="https://www.instagram.com/explore/tags/sprawnościnacałeżycie/"
            target="_blank"
          >
            #sprawnościnacałeżycie
          </a> <a
            class="z-link"
            href="https://www.instagram.com/explore/tags/harcerstwo/"
            target="_blank"
          >
            #harcerstwo
          </a> ⚜️`
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
    const title = 'Związek Harcerstwa Polskiego'
    const description = ''
    const image = 'https://zhp.pl/wp-content/uploads/2015/01/zhp_fb.png'
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
      grid-column: span 12;

      @media (min-width: 640px) {
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
}
</style>
