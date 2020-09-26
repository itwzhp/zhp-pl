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
      tags: [],
      categories: [
        {
          id: 'eventType',
          label: 'Rodzaj wydarzenia',
          options: [
            { label: 'Obóz' },
            { label: 'Zlot' },
            { label: 'Konferencja' },
          ],
        },
        {
          id: 'ageGroups',
          label: 'Metodyka',
          options: [
            { label: 'Zuchy' },
            { label: 'Harcerze' },
            { label: 'Harcerze Stars' },
            { label: 'Wędrownicy' },
          ],
        },
        {
          id: 'district',
          label: 'Województwo',
          options: [
            { label: 'Opolskie' },
            { label: 'Dolnośląskie' },
            { label: 'Śląskie' },
            { label: 'Podkarpackie' },
          ],
        },
      ],
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
  },
  created() {
    this.requestApi();
  },
  methods: {
    updatePage(direction) {
      this.requestApi(direction);
    },
    async fetchAPI(url, params) {
      const response = await axios.get(url, { params });
      return {
        data: response.data,
        totalPages: parseInt(response.headers['x-wp-totalpages'], 10),
      };
    },
    async requestApi(direction = 0) {
      const { API_URL } = process.env;

      const events = await this.fetchAPI(`${API_URL}/events`, {
        per_page: this.page === 1 ? 13 : 12,
        page: this.page + direction,
      });
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
