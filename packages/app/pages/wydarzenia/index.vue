<template>
  <div id="events">
    <ZSection
      title="Wydarzenia"
      subtitle="Znajdź wydarzenia dla siebie i swojej drużyny"
      class="section"
    >
      <div class="sidebar">
        <ZFiltersEvents
          :categories="categories"
          :selected="selectedFilters"
          @submit="updateQuery"
        />
      </div>
      <template v-for="(event, index) in events">
        <ZEvent
          :key="event.id"
          :thumbnail="event.rest_media"
          :title="event.title.rendered"
          :date="event.rest_acf.date"
          :location="{name: event._embedded['wp:term'][0][0] && event._embedded['wp:term'][0][0].name, to:'#'}"
          :type="event.rest_event_type"
          :audiences="event.age_groups.map((ageGroup)=>(ageGroups[ageGroup]))"
          :excerpt="page === '1' && index === 0 ? event.excerpt.rendered : ''"
          :to="`/wydarzenia/${event.slug}`"
          class="event"
          :class="{'z-event--primary': page === '1' && index === 0, 'event--primary': index === 0}"
        />
      </template>
    </ZSection>
    <ZPagination
      :page="page"
      :total-pages="totalPages"
      class="pagination"
      @change="updateQuery({page: $event})"
    />
  </div>
</template>

<script>
import {
  ZSection,
  ZPagination,
  ZFiltersEvents,
  ZEvent
} from '@nowa-zhp/ui'

export default {
  watchQuery: true,
  components: {
    ZSection,
    ZPagination,
    ZFiltersEvents,
    ZEvent
  },
  async asyncData ({ $axios, params, query }) {
    // helpers
    const reduce = (accumulator, option) => ({
      ...accumulator,
      [option.id]: map(option)
    })
    // FIXME: remove this mapping, base on native taxonomies fields or exclude it in Vuex
    const map = option => ({
      id: option.id,
      label: option.name,
      value: `${option.id}`,
      taxonomy: option.taxonomy === 'post_tag'
        ? 'tags' // FIXME: hack for differences from rest request and taxonomy name
        : `${option.taxonomy}s` // FIXME: hack for differences from taxonomy name and rest_base
    })
    // events
    const eventsRes = await $axios.get('events', { params: { _embed: true, per_page: 13, page: 1, ...query } })
    const events = eventsRes.data
    const totalPages = eventsRes.headers['x-wp-totalpages']
    // TODO: move event_types to vuex
    const eventTypesRes = await $axios('event_types', { params: { per_page: 99 } })
    const eventTypes = eventTypesRes.data.reduce(reduce, {})
    // TODO: base on age_groups from vuex
    const ageGroupsRes = await $axios('age_groups', { params: { per_page: 99 } })
    const ageGroups = ageGroupsRes.data.reduce(reduce, {})
    // TODO: move district to vuex
    const localizationsRes = await $axios('localizations', { params: { per_page: 99, parent: 0 } })
    const localizations = localizationsRes.data.reduce(reduce, {})
    const categories = {
      event_types: {
        id: 'event_types',
        label: 'Rodzaj wydarzenia',
        options: {
          0: {
            id: 0,
            label: 'Wybierz rodzaj wydarzenia',
            value: ''
          },
          ...eventTypes
        }
      },
      age_groups: {
        id: 'age_groups',
        label: 'Dla kogo',
        options: {
          0: {
            id: 0,
            label: 'Wybierz dla kogo',
            value: ''
          },
          ...ageGroups
        }
      },
      localizations: {
        id: 'localizations',
        label: 'Gdzie',
        options: {
          0: {
            id: 0,
            label: 'Wybierz gdzie',
            value: ''
          },
          ...localizations
        }
      }
    }
    const filtersKeys = ['event_types', 'age_groups', 'localizations', 'before', 'after']
    const selectedFilters = Object.keys(query).reduce((accumulator, param) => {
      if (filtersKeys.includes(param)) {
        return {
          ...accumulator,
          [param]: query[param]
        }
      } else {
        return accumulator
      }
    }, {})
    return {
      events,
      categories,
      selectedFilters,
      page: query.page || '1',
      totalPages
    }
  },
  computed: {
    ageGroups () {
      return this.$store.getters['taxonomies/taxonomy']('age_groups')
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
    }
  },
  head () {
    const title = 'Wydarzenia | Związek Harcerstwa Polskiego'
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
#events {
  overflow: hidden;

  .sidebar {
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 4;
      grid-row: span 4;
    }

    @media (min-width: 768px) {
      grid-column: span 3;
    }
  }

  .event {
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 4;
    }

    @media (min-width: 768px) {
      grid-column: span 3;
    }

    &--primary {
      @media (min-width: 640px) {
        grid-column: span 12;
        grid-row: -1;
      }
    }
  }

  .pagination {
    max-width: 1140px;
    padding: 0 1.25rem;
    margin: 32px auto;
  }

  .section {
    @media (min-width: 640px) {
      --section-margin: 3rem 0;
    }
  }
}
</style>
