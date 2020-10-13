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
          :selected-filters="selectedFilters"
          @submit="updateFilters"
          @update="updateFilters"
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
          :audience="event.rest_age_group"
          :excerpt="page === 1 && index === 0 && event.excerpt.rendered"
          :to="`/wydarzenia/${event.slug}`"
          class="event"
          :class="{'z-event--primary': page === 1 && index === 0, 'event--primary': index === 0}"
        />
      </template>
    </ZSection>
    <ZPagination
      :page="1"
      :total-pages="10"
      class="pagination"
      @change="()=>(true)"
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
  name: 'Events',
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
    const map = option => ({
      id: option.id,
      label: option.name,
      value: option.id
    })
    // events
    const eventsRes = await $axios.get('events', { params: { per_page: 13, ...query } })
    const events = eventsRes.data
    // tags
    const tagsRes = await $axios('tags', {})
    const tags = tagsRes.data.reduce(reduce, {})
    // event_types
    const eventTypesRes = await $axios('event_types', {})
    const eventTypes = eventTypesRes.data.reduce(reduce, {})
    // age_groups
    const ageGroupsRes = await $axios('age_groups', {})
    const ageGroups = ageGroupsRes.data.reduce(reduce, {})
    // districts
    const districtsRes = await $axios('districts', {})
    const districts = districtsRes.data.reduce(reduce, {})
    // categories
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

    return {
      events,
      categories,
      tags,
      selectedFilters: {},
      page: 1,
      query
    }
  },
  methods: {
    updateFilters (filters) {
      const filtersQuery = (filters) => {
        let query = {}
        if (filters.date) {
          // TODO: add support for ACF date
        }
        if (filters.categories) {
          query = { ...query, ...filters.categories }
        }
        if (filters.tags) {
          query.tags = [...filters.tags]
        }
        return query
      }
      this.$router.push({ path: this.$route.path, query: filtersQuery(filters) })
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