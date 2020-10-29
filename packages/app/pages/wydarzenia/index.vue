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
          :tags="tags"
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
          :location="{name: 'Warszawa', to:'#'}"
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
    const eventsRes = await $axios.get('events', { params: { per_page: 13, page: 1, ...query } })
    const events = eventsRes.data
    const totalPages = eventsRes.headers['x-wp-totalpages']
    // TODO: move tags to vuex
    const tagsRes = await $axios('tags', {})
    const tags = tagsRes.data.reduce(reduce, {})
    // TODO: move event_types to vuex
    const eventTypesRes = await $axios('event_types', {})
    const eventTypes = eventTypesRes.data.reduce(reduce, {})
    // TODO: base on age_groups from vuex
    const ageGroupsRes = await $axios('age_groups', { params: { per_page: 99 } })
    const ageGroups = ageGroupsRes.data.reduce(reduce, {})
    // TODO: move district to vuex
    const districtsRes = await $axios('districts', {})
    const districts = districtsRes.data.reduce(reduce, {})
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
        label: 'Metodyki',
        options: {
          0: {
            id: 0,
            label: 'Wybierz metodykę',
            value: ''
          },
          ...ageGroups
        }
      },
      districts: {
        id: 'districts',
        label: 'Województwa',
        options: {
          0: {
            id: 0,
            label: 'Wybierz województwo',
            value: ''
          },
          ...districts
        }
      }
    }
    const filtersKeys = ['tags', 'event_types', 'age_groups', 'districts', 'before', 'after']
    const selectedFilters = Object.keys(query).reduce((accumulator, param) => {
      if (filtersKeys.includes(param)) {
        return {
          ...accumulator,
          [param]: param === 'tags'
            ? query[param].split(',')
            : query[param]
        }
      } else {
        return accumulator
      }
    }, {})
    return {
      events,
      categories,
      tags,
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
  }
}
</script>

<style lang="scss">
#events {
  overflow: hidden;

  .sidebar {
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 3;
      grid-row: span 4;
    }
  }

  .event {
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 3;
    }

    &--primary {
      @media (min-width: 480px) {
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
    @media (min-width: 480px) {
      --section-margin: 3rem 0;
    }
  }
}
</style>
