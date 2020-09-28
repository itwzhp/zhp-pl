<template>
  <div id="events">
    <ZSection
      title="Wydarzenia"
      subtitle="Znajdź wydarzenia dla siebie i swojej drużyny"
      style="--section-margin: 0;"
    >
      <div class="sidebar">
        <ZFiltersEvents
          :categories="categories"
          :tags="tags"
          :selected-filters="selectedFilters"
          @submit="submitFilters"
          @update="updateFilters"
        />
      </div>
      <template v-for="(event, index) in events">
        <ZEvent
          :key="event.id"
          :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${event.rest_media.file}`"
          :title="event.title.rendered"
          :date="event.rest_acf.date"
          :location="{name: 'Warszawa'}"
          :audience="{name: 'Wszyscy harcerze'}"
          :type="event.rest_event_type"
          :age-group="event.rest_age_group"
          :excerpt="event.excerpt.rendered"
          class="event"
          :class="{'z-event--primary': page === 1 && index === 0, 'event--primary': index === 0}"
        />
      </template>
    </ZSection>
    <ZPagination style=" max-width: 1120px; margin: 32px auto;" />
  </div>
</template>

<script>
import axios from 'axios';
import {
  ZSection,
  ZEvent,
  ZFiltersEvents,
  ZPagination,
} from '../../../index';

export default {
  name: 'Events',
  components: {
    ZFiltersEvents,
    ZSection,
    ZEvent,
    ZPagination,
  },
  data() {
    return {
      date: [],
      tags: {},
      categories: {},
      selectedFilters: {},
      events: [],
      page: 1,
      totalPages: 0,
    };
  },
  computed: {
    mountCarousel() {
      return this.posts.length > 0;
    },
    hasNextPage() {
      return this.page < this.totalPages;
    },
    hasPreviousPage() {
      return this.page > 1;
    },
    filtersQuery() {
      let query = {};
      if (this.selectedFilters.date) {
        // date from ACF
      }
      if (this.selectedFilters.categories) {
        query = { ...query, ...this.selectedFilters.categories };
      }
      if (this.selectedFilters.tags) {
        query.tags = [...this.selectedFilters.tags];
      }
      return query;
    },
  },
  watch: {
    selectedFilters() {
      this.requestEvents(this.filtersQuery);
    },
  },
  created() {
    this.requestApi();
  },
  methods: {
    reduceOptions(accumulator, option) {
      return {
        ...accumulator,
        [option.id]: this.mapOption(option),
      };
    },
    mapOption(option) {
      return {
        id: option.id,
        label: option.name,
        value: option.id,
      };
    },
    updatePage(direction) {
      this.requestApi(direction);
    },
    updateFilters(filters) {
      this.selectedFilters = { ...filters };
    },
    submitFilters(filters) {
      this.selectedFilters = { ...filters };
    },
    async fetchAPI(url, params) {
      const response = await axios.get(url, { params });
      return {
        data: response.data,
        totalPages: parseInt(response.headers['x-wp-totalpages'], 10),
      };
    },
    async requestEvents(params) {
      const { API_URL } = process.env;
      const eventParams = {
        per_page: this.page === 1 ? 13 : 12,
        ...params,
      };
      const events = await this.fetchAPI(`${API_URL}/events`, eventParams);
      this.events = events.data;
      this.totalPages = events.totalPages;
    },
    async requestApi(direction = 0) {
      const { API_URL } = process.env;

      const tags = await this.fetchAPI(`${API_URL}/tags`, { hide_empty: true });
      this.tags = tags.data.reduce(this.reduceOptions, {});

      const eventTypes = await this.fetchAPI(`${API_URL}/event_types`, { hide_empty: true });
      const ageGroups = await this.fetchAPI(`${API_URL}/age_groups`, { hide_empty: true });
      const districts = await this.fetchAPI(`${API_URL}/districts`, { hide_empty: true });
      this.categories = {
        event_types: {
          id: 'event_types',
          label: 'Rodzaj wydarzenia',
          options: {
            0: { id: 0, label: 'Wybierz rodzaj wydarzenia', value: '' },
            ...eventTypes.data.reduce(this.reduceOptions, {}),
          },
        },
        age_groups: {
          id: 'age_groups',
          label: 'Metodyka',
          options: {
            0: { id: 0, label: 'Wybierz metodykę', value: '' },
            ...ageGroups.data.reduce(this.reduceOptions, {}),
          },
        },
        districts: {
          id: 'districts',
          label: 'Wojewdztwo',
          options: {
            0: { id: 0, label: 'Wybierz województwo', value: '' },
            ...districts.data.reduce(this.reduceOptions, {}),
          },
        },
      };
      const eventParams = {
        per_page: this.page === 1 ? 13 : 12,
        page: this.page + direction,
      };
      const events = await this.fetchAPI(`${API_URL}/events`, eventParams);
      this.events = events.data;
      this.totalPages = events.totalPages;

      this.page += direction;
    },
  },
};
</script>

<style lang="scss">
  #events {
    .sidebar {
      grid-column: span 3;
      grid-row: span 4;
    }

    .event {
      grid-column: span 3;

      &--primary {
        grid-column: span 12;
        grid-row: -1;
      }
    }
  }
</style>
