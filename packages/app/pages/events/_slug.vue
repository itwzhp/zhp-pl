<template>
  <div id="event">
    <ZSection
      tag="div"
    >
      <ZHeading
        :level="1"
        class="title t3"
      >
        {{ event.title.rendered }}
      </ZHeading>
      <!-- ZMetaPost<- for event -->
      <ZMetaEvent
        :thumbnail="event.rest_media"
        :date="event.rest_acf.date"
        :location="{name: 'Warszawa', to:'#'}"
        :type="event.rest_event_type"
        :audience="event.rest_age_group"
        class="meta"
      />
      <div class="sidebar">
        <ZEventOrganizer
          :organizer="event.rest_acf.organizer"
          :web="event.rest_acf.web"
        />
      </div>
      <ZWordPress
        class="content"
        :html="event.content.rendered"
      />
      <ZFiles
        v-if="filesMock"
        title="Linki i dokumenty powiązane z artykułem:"
        :files="filesMock"
        class="files"
      />
    </ZSection>
    <ZSection class="related">
      <ZHeading class="related__title">
        Mogą Cię także zainteresować:
      </ZHeading>
      <ZCarousel
        v-if="relatedEvents.length > 0"
        :peeked="true"
        :settings="{
          breakpoints: {
            480: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="z-carousel--peeked related__carousel"
      >
        <template v-for="relatedEvent in relatedEvents">
          <li
            :key="relatedEvent.id"
            class="glide__slide"
          >
            <ZEvent
              :key="relatedEvent.id"
              :thumbnail="relatedEvent.rest_media"
              :title="relatedEvent.title.rendered"
              :date="relatedEvent.rest_acf.date"
              :location="{name: 'Warszawa', to:'#'}"
              :type="relatedEvent.rest_event_type"
              :audience="relatedEvent.rest_age_group"
              :to="`/events/${relatedEvent.slug}`"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
  </div>
</template>

<script>
import {
  ZSection,
  ZHeading,
  ZCarousel,
  ZEvent,
  ZFiles,
  ZWordPress,
  ZEventOrganizer,
  ZMetaEvent
} from '@nowa-zhp/ui'

export default {
  name: 'Event',
  components: {
    ZSection,
    ZHeading,
    ZCarousel,
    ZEvent,
    ZFiles,
    ZWordPress,
    ZEventOrganizer,
    ZMetaEvent
  },
  async asyncData ({ $axios, params, query }) {
    // events
    const eventRes = await $axios.get('events', { params })
    const event = eventRes.data[0]
    // related events
    const relatedEventsRes = await $axios.get('events', { per_page: 8 })
    const relatedEvents = relatedEventsRes.data
    // filesMock
    const filesMock = [
      { type: 'Link', name: 'Rejestracja patroli', url: '#' },
      {
        type: 'Dokument', name: 'Formularz zgłoszeniowy', url: '#', date: '12.07.2020', mimeType: 'Dokument Word'
      },
      {
        type: 'Dokument', name: 'Formularz zgłoszeniowy', url: '#', date: '12.07.2020', mimeType: 'Dokument PDF'
      }
    ]

    return { event, relatedEvents, filesMock }
  }
}
</script>

<style lang="scss">
#event {
  overflow: hidden;

  .title {
    margin: 32px 0;
    grid-column: span 12;
    grid-row: 1;
  }

  .meta {
    margin: 0 0 24px 0;
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 8;
      grid-row: 3;
    }
  }

  .content {
    margin: 0 0 48px 0;
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 8;
      grid-row: 4;
    }
  }

  .sidebar {
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 4;
      grid-row: 3 / span 3;
    }
  }

  .files {
    grid-column: span 8;
    grid-row: 5;
  }

  .related {
    &__title {
      grid-column: span 12;
      place-self: center;
    }

    &__carousel {
      grid-column: span 12;
    }
  }
}
</style>
