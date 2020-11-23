<template>
  <div id="search">
    <div class="hero-wrapper">
      <ZSection class="section-hero">
        <div class="section-hero__picture">
          <ZClipPath :hero-image="page._embedded['wp:featuredmedia'][0].media_details.sizes.medium_large.source_url" />
        </div>
        <ZHeading
          class="t4 section-hero__title uppercase"
        >
          {{ title }}
        </ZHeading>
        <ZSearch
          class="section-hero__search"
          @submit="submit"
        />
      </ZSection>
    </div>
  </div>
</template>

<script>
import {
  ZSection,
  ZClipPath,
  ZSearch,
  ZHeading
} from '@nowa-zhp/ui'

export default {
  watchQuery: true,
  components: {
    ZSection,
    ZClipPath,
    ZSearch,
    ZHeading
  },
  async asyncData ({ $axios, params, query }) {
    const pageRes = await $axios.get('pages', { params: { slug: 'undefined', _embed: true, per_page: 16 } })
    const page = pageRes.data.shift()
    return { page }
  },
  computed: {
    title () {
      return `Ups, nie ma takiej strony!`
    }
  },
  methods: {
    updateQuery (query) {
      const requestQuery = { ...this.$route.query, ...query }
      this.$router.push({
        path: this.$route.path,
        query: Object.keys(requestQuery)
          .filter((param) => {
            switch (param) {
              case 'page':
                return parseInt(requestQuery[param], 10) > 1
              default:
                return true
            }
          })
          .reduce((accumulator, param) => {
            return requestQuery[param]
              ? { ...accumulator, [param]: requestQuery[param] }
              : accumulator
          }, {})
      })
    },
    submit (query) {
      this.$router.push({
        path: '/szukaj',
        query: { search: query }
      })
    }
  },
  head () {
    const title = 'Strona nie została znaleziona | Związek Harcerstwa Polskiego'
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
#search {
  overflow: hidden;

  .pagination {
    max-width: 1140px;
    padding: 0 1.25rem;
    margin: 32px auto;
  }

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
        grid-column: span 9;
        grid-row: span 2;
      }
    }

    &__title {
      margin: 0 0 1.5rem 0;
      grid-column: span 12;
      place-self: end stretch;

      @media (min-width: 480px) {
        grid-column: span 13;
      }
    }

    &__search {
      grid-column: span 12;
      place-self: start stretch;

      @media (min-width: 480px) {
        grid-column: span 13;
      }
    }
  }
}
</style>
