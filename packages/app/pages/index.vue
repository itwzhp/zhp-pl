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
      v-if="hasAbout && basicInfos.length>0"
      :title="about.title"
      :subtitle="about.subtitle"
      class="section-about-us"
    >
      <template v-for="(tile, key) in basicInfos">
        <ZCard
          :key="key"
          :thumbnail="tile.thumbnail || placeholder"
          :title="tile.title"
          :description="tile.description"
          :to="tile.to ? urlParser(tile.to) : ''"
          class="section-about-us__tile"
          :class="{
            'z-card--pictured': isOverlayed,
            'z-card--overlayed': isOverlayed,
          }"
        />
      </template>
    </ZSection>
    <ZSection
      v-if="hasPosts"
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
    <ZSection
      v-if="hasHighlighted"
      class="section-highlighted"
    >
      <component
        :is="highlightedComponent"
        :title="newsCard.title.rendered"
        :thumbnail="newsCard._embedded['wp:featuredmedia'] ? newsCard._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url : placeholder"
        :to="newsCard.rest_redirect ? newsCard.rest_redirect :`/${newsCard.date.split('-')[0]}/${newsCard.slug}`"
        :date="newsCard.date"
        class="section-highlighted__card"
      />
      <ZHighlighted
        :title="highlighted.title"
        :posts="news"
        class="section-highlighted__posts"
      />
    </ZSection>
    <ZSection
      v-if="hasMeet"
      class="section-about-us"
    >
      <ZBanner
        v-bind="meet"
        cover-type="video"
        class="section-about-us__banner"
      >
        <template #thumbnail="{thumbnail}">
          <ZVideo
            class="z-banner__thumbnail section-about-us__video"
            v-bind="thumbnail"
          />
        </template>
      </ZBanner>
    </ZSection>
    <ZSection
      v-if="hasJoin"
      class="section-join-us"
    >
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
      <component
        :is="joinComponent"
        :title="joinUs.title.rendered"
        :thumbnail="joinUs._embedded['wp:featuredmedia'] ? joinUs._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url : placeholder"
        :to="joinUs.rest_redirect ? joinUs.rest_redirect :`/${joinUs.date.split('-')[0]}/${joinUs.slug}`"
        :date="joinUs.date"
        class="section-join-us__post"
      />
    </ZSection>


    <ZSection class="section-mission" v-if="hasMission">
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
      v-if="hasEvents"
      class="section-events"
      title="Przedsięwzięcia i&nbsp;wydarzenia"
      subtitle="Szukasz rajdu dla swojej drużyny? Albo konkursu dla swojej gromady? A&nbsp;może chcesz wziąć udział w&nbsp;kursie? Sprawdź, co odbywa się w&nbsp;najbliższym czasie."
      :more="{name: 'wydarzenia'}"
    >
      <ZCarousel
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
              :location="{name: event.rest_localization && event.rest_localization.name, to:'#'}"
              :type="event.rest_event_type"
              :audiences="event.age_groups.map((ageGroup)=>(ageGroups[ageGroup]))"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
    <ZSection
      v-if="hasSocial"
      class="section-social"
    >
      <ZInstagram
        v-if="hasInstagram"
        v-bind="instagram"
        :feed="feed"
        class="section-social__instagram"
        :class="{
          'section-social__instagram--just-two': !hasAllSocialWidgets
        }"
      />
      <ZFacebook
        v-if="hasFacebook"
        v-bind="facebook"
        class="section-social__facebook"
        :class="{
          'section-social__facebook--just-two': !hasAllSocialWidgets
        }"
      />
      <div
        class="section-social__partners"
        :class="{
          'section-social__partners--just-two': !hasAllSocialWidgets
        }"
      >
        <ZLink
          :to="urlParser(partnersMeta.to)"
          class="t4 uppercase"
          style="--link-text-decoration: none;"
          v-html="partnersMeta.title"
        />
        <ZCarousel
          v-if="partners.length"
          ref="partners"
          :has-controls="false"
          :settings="{
            autoplay: partners.length >= 4 ? 3000 : 0,
            type: partners.length >= 4 ? 'carousel' : 'slider',
            perView: 3,
            peek: {
              before: 0,
              after: 55
            },
            breakpoints: {
              640: {
                autoplay: 3000,
                type: 'carousel',
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
          <template v-for="(partner, key) in partners">
            <li
              :key="key"
              class="glide__slide"
            >
              <ZImage
                v-if="partner.hasFeaturedImage"
                :src="partner.featuredImage.url"
                :lazy="false"
              />
            </li>
          </template>
        </ZCarousel>
        <div
          v-if="banners.length"
          class="partner-banners"
        >
          <template v-for="(banner, key) in banners">
            <ZImage
              v-if="banner.hasFeaturedImage"
              :key="key"
              :src="banner.featuredImage.url"
              class="partner-banners__banner"
            />
          </template>
        </div>
      </div>
    </ZSection>
    <ZSection
      v-else
      class="section-partners"
      :title="partnersMeta.title"
    >
      <template #title>
        <ZHeading class="z-section__title">
          <ZLink
            :to="urlParser(partnersMeta.to )"
            class="t4 uppercase"
            style="--link-text-decoration: none;"
            v-html="partnersMeta.title"
          />
        </ZHeading>
      </template>
      <ZCarousel
        v-if="partners.length"
        ref="partners"
        :has-controls="false"
        :settings="{
          autoplay: partners.length >= 4 ? 3000 : 0,
          type: partners.length >= 4 ? 'carousel' : 'slider',
          breakpoints: {
            640: {
              autoplay: 3000,
              type: 'carousel',
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
              v-if="partner.hasFeaturedImage"
              :src="partner.featuredImage.url"
              :lazy="false"
            />
          </li>
        </template>
      </ZCarousel>
      <div
        v-if="banners.length"
        class="partner-banners"
      >
        <template v-for="(banner, key) in banners">
          <ZImage
              v-if="banner.hasFeaturedImage"
              :key="key"
              :src="banner.featuredImage.url"
            class="partner-banners__banner"
          />
        </template>
      </div>
    </ZSection>
  </div>
</template>

<script>
import debounce from 'lodash.debounce'
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
  ZLink,
  ZHighlighted,
  ZInstagram,
  ZVideo
} from '@zhp-pl/ui'
import ZFacebook from '@/components/organisms/ZFacebook.vue'
import Partner from '@/viewModel/Partner'
import Banner from '@/viewModel/Banner'
import { mapGetters } from 'vuex'
import UrlParser from '../helpers/UrlParser'
const resize = debounce(() => {
  if (!window.FB) { return }
  window.FB.XFBML.parse()
}, 300)
export default {
  components: {
    ZVideo,
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
    ZLink,
    ZHighlighted,
    ZFacebook,
    ZInstagram
  },
  async asyncData ({ $axios, store }) {
    // * get homepage settings
    const homepageRes = await $axios.get('pages', { params: { slug: 'strona-glowna', _embed: true } })
    const homepage = homepageRes.data.shift()

    // * get posts for Polecamy
    const postsParams = { per_page: 25, _embed: true }
    if (homepage.rest_acf.posts.categories) {
      postsParams.categories = homepage.rest_acf.posts.categories
    }
    const postsRes = await $axios.get('posts', { params: postsParams })
    const posts = postsRes.data

    // * get events for Przedsięwziecia i wydarzenia
    if (homepage && homepage.rest_acf && homepage.rest_acf.event_categories) {
      eventsParams.event_categories = homepage.rest_acf.event_categories.join(',')
    }
    const eventsParams = {
      per_page: 25,
      page: 1,
      without_outdated: true
    }
    const eventsRes = await $axios.get('acf-events', { params: eventsParams })
    const events = eventsRes.data

    // * get post for Chcesz zapisać...
    const joinUsParams = {
      per_page: 1,
      _embed: true
    }
    if (homepage.rest_acf.join.tags) {
      joinUsParams.tags = homepage.rest_acf.join.tags
    }
    const joinUsRes = await $axios.get('posts', { params: joinUsParams })
    const joinUs = joinUsRes.data.shift()

    // * get logos for Partnerzy
    const partnersParams = {
      per_page: 99,
      _embed: true
    }
    if (homepage.rest_acf.partners.categories) {
      partnersParams.logo_categories = homepage.rest_acf.partners.categories
    }

    const partnersRes = await $axios.get('logos', { params: partnersParams })
    const partners = partnersRes.data.map((responseItem)=>new Partner(responseItem))

    const bannersParams = {
      per_page: 99,
      _embed: true
    }
    if (homepage.rest_acf.partners.banner_categories) {
      bannersParams.logo_categories = homepage.rest_acf.partners.banner_categories
    }
    const bannersRes = await $axios.get('logos', { params: bannersParams })
    const banners = bannersRes.data.map((responseItem)=> new Banner(responseItem))

    // * get posts for Aktualności
    const newsParams = { per_page: 5 }
    if (homepage.rest_acf.highlighted.categories) {
      newsParams.categories = homepage.rest_acf.highlighted.categories
    }
    const newsRes = await $axios.get('posts', { params: newsParams })
    const news = newsRes.data.map(news => ({ ...news, title: news.title.rendered }))

    // * get basic infos
    let aboutParams =  {
      per_page: 50
    };
    let basicInfos = [];
    if (homepage.rest_acf.about.categories) {
      aboutParams.categories = homepage.rest_acf.about.categories;
      const basicInfosRes = await $axios.get('posts', { params: aboutParams });
      
      basicInfos = basicInfosRes.data.map(basicInfo => ({
        thumbnail: basicInfo.rest_media,
        title: basicInfo.title.rendered, 
        description: basicInfo.content.rendered.split('<!--more-->')[0].replace(/(<([^>]+)>)/gi, "").trim(),
        to: basicInfo.link
      }))
    }


    // * get post for Aktualności
    const newsCardParams = { per_page: 1, _embed: true }
    if (homepage.rest_acf.highlighted.tags) {
      newsCardParams.tags = homepage.rest_acf.highlighted.tags
    }
    const newsCardRes = await $axios.get('posts', { params: newsCardParams })
    const newsCard = newsCardRes.data.shift()

    // * get instagram html to parse, and store it in store
    const instagram = homepage.rest_acf.social.instagram
    const hasInstagram = instagram.image &&
        instagram.user &&
        instagram.name &&
        instagram.description;
    if (hasInstagram && !Object.keys(store.state.instagram.posts).length) {
      const instagramRes = await $axios.get('instagram')
      const instagram = instagramRes.data || ''
      const images = instagram.match(/href="(.+?)".+?data-full-res="(.+?)"/gm) || []
      const feed = images.map(match => (
        { href: match.match(/href="(.+?)"/)[1], src: match.match(/data-full-res="(.+?)"/)[1] }
      ))
      store.commit('instagram/update', feed)
    }

    return { homepage, posts, events, partners, banners, joinUs, news, newsCard, basicInfos }
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
    hasAbout () {
      return this.about.visible
    },
    mission(){
      return this.homepage.rest_acf.mission;
    },
    hasMission(){
      return this.mission.visible;
    },
    isOverlayed () {
      return this.about.overlayed
    },
    hasPosts () {
      return this.homepage.rest_acf.posts.visible && this.posts.length >= 4
    },
    hasEvents () {
      return this.homepage.rest_acf.events.visible && this.events.length >= 4
    },
    meet () {
      return { ...this.homepage.rest_acf.meet, thumbnail: { src: this.homepage.rest_acf.meet.thumbnail } }
    },
    hasMeet () {
      const meet = this.homepage.rest_acf.meet
      return meet.visible && meet.thumbnail
    },
    highlighted () {
      return this.homepage.rest_acf.highlighted
    },
    hasHighlighted () {
      return this.highlighted.visible
    },
    highlightedComponent () {
      return `z-${this.highlighted.component}`
    },
    join () {
      return this.homepage.rest_acf.join
    },
    joinComponent () {
      return `z-${this.join.component}`
    },
    hasJoin () {
      return this.homepage.rest_acf.join.visible
    },
    partnersMeta () {
      return this.homepage.rest_acf.partners
    },
    social () {
      return this.homepage.rest_acf.social
    },
    facebook () {
      return this.social.facebook
    },
    hasFacebook () {
      return this.facebook.appId &&
          this.facebook.fbPageUrl
    },
    instagram () {
      return this.social.instagram
    },
    hasInstagram () {
      return this.instagram.image &&
          this.instagram.user &&
          this.instagram.name &&
          this.instagram.description &&
          this.feed.length >= 0
    },
    hasSocial () {
      return this.social.visible && (this.hasFacebook || this.hasInstagram)
    },
    feed () {
      return this.$store.getters['instagram/posts']
    },
    hasAllSocialWidgets () {
      const social = [this.hasInstagram, this.hasFacebook, true]
      return social.filter(state => (state)).length === 3
    }
  },
  mounted () {
    this.$nextTick(() => {
      const glide = this.$refs?.partners?.glide
      const isMobile = matchMedia('(max-width: 640px)').matches
      if (!isMobile) {
        if (glide) {
          glide.index = 0
          glide.disabled = true
        }
      }
      matchMedia('(max-width: 640px)').addListener((e) => {
        if (e.matches) {
          if (glide) {
            glide.disabled = false
          }
          return
        }
        if (glide) {
          glide.index = 0
          glide.disabled = true
        }
      })
    })
    window.addEventListener('resize', resize)
  },
  beforeDestroy () {
    window.removeEventListener('resize', resize)
  },
  methods: {
    urlParser(url){
      const parser = new UrlParser(this.$store)
      return parser.parse(url)
    },
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
      --post-grid-template-rows: 1fr 128px;

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
      width: 100%;
      padding: 10%;
      transform: translate(-50%, -50%);
    }
  }

  .section-partners {
    &::before {
      content: none;
    }
  }

  .section-social {
    &__instagram {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 4;
      }

      &--just-two {
        @media (min-width: 640px) {
          grid-column: span 6;
        }
      }
    }

    &__facebook {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 3;
      }

      &--just-two {
        @media (min-width: 640px) {
          grid-column: span 6;
        }
      }
    }

    &__partners {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 5;
      }

      &--just-two {
        @media (min-width: 640px) {
          grid-column: span 6;
        }
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

  .partner-banners {
    margin: 1rem 0 0 0;
    grid-column: span 12;

    &__banner {
      &:not(:first-of-type) {
        margin: 0.5rem 0 0 0;
      }
    }
  }
}
</style>
