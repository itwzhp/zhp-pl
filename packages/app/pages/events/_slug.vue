<template>
  <div id="event">
    <ZSection tag="div">
      <ZHeading
        :level="1"
        class="title"
      >
        {{ event.title.rendered }}
      </ZHeading>
      <!-- ZMeta <- for event -->
      <ZImage
        :src="event.rest_media"
        class="cover"
      />
      <!-- kalendarz -->
      <!-- miejsce, wydarzenie, metodyka-->
      <div class="content" v-html="event.content.rendered" />
      <div v-if="filesMock" class="z-files files">
        <!-- linki i dokumenty powiązane z artykułem -->
        <ZHeading
          :level="3"
          class="z-files__title"
        >
          <ZLink to="$">
            Linki i dokumenty powiązane z artykułem
          </ZLink>
        </ZHeading>
        <ZList class="z-files__files">
          <template v-for="(file, key) in filesMock">
            <li :key="key">
              <div class="z-file">
                <div class="z-file__type">
                  {{ file.type }}
                </div>
                <ZHeading
                  :level="4"
                  class="z-file__name"
                >
                  <ZLink :to="file.url">
                    {{ file.name }}
                  </ZLink>
                </ZHeading>
                <div class="z-file__meta">
                  {{ file.mimeType }}, {{ file.date }}
                </div>
              </div>
            </li>
          </template>
        </ZList>
      </div>
      <div class="sidebar">
        <div>
          &nbsp;<ZHeading>Organizator:</ZHeading>
          <ZText>Główna Kwatera ZHP</ZText>
          <ZText>Jan Kowalski</ZText>
          <ZText>
            T: <ZLink to="tel:+48 221 231 214">
              +48 221 231 214<ZLink />
            </zlink>
          </ZText>
          <ZText>
            @: <ZLink to="maito: jan.kowalski@gmail.com">
              jan.kowalski@gmail.com<ZLink />
            </zlink>
          </ZText>
        </div>
      </div>
      </zimage>
    </ZSection>
    <ZSection class="related">
      <ZHeading class="z-heading--uppercase related__title">
        Mogą Cię także zainteresować:
      </ZHeading>
      <ZCarousel
        v-if="relatedEvents.length > 0"
        :peeked="true"
        :settings="{
          type: 'carousel',
          perView: 4,
          gap: 20,
          autoplay: 3000,
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
              :location="{name: 'Warszawa'}"
              :audience="{name: 'Wszyscy harcerze'}"
              :type="relatedEvent.rest_event_type"
              :age-group="relatedEvent.rest_age_group"
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
  ZText,
  ZLink,
  ZList,
  ZImage
} from '@nowa-zhp/ui'

export default {
  name: 'Event',
  components: {
    ZSection,
    ZHeading,
    ZCarousel,
    ZEvent,
    ZText,
    ZLink,
    ZList,
    ZImage
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
    grid-column: span 8;
    grid-row: 2;
  }

  .cover {
    display: flex;
    overflow: hidden;
    height: 396px;
    border-radius: 10px;
    grid-column: span 8;
    grid-row: 3;

    img {
      object-fit: cover;
    }
  }

  .content {
    margin: 0 0 48px 0;
    grid-column: span 8;
    grid-row: 4;
  }

  .sidebar {
    grid-column: span 4;
    grid-row: 3 / span 3;
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

  p {
    margin: 20px 0;
  }

  .image {
    display: flex;
    overflow: hidden;
    border-radius: 10px;
  }
}

.z-files {
  &__title {
    margin: 1rem 0;
  }

  &__files {
    display: grid;
    gap: 12px;
    grid-auto-flow: row;
  }
}

.z-file {
  position: relative;
  display: grid;
  align-items: center;
  justify-content: space-between;
  padding: 32px 16px;
  border: 1px solid #a6ce39;
  border-radius: 2px;
  grid-template-columns: repeat(2, auto);

  //&__name {}

  &__type {
    position: absolute;
    top: 8px;
    left: 8px;
    font-size: 12px;
    font-weight: 100;
  }

  &__meta {
    color: #a6ce39;
  }
}
</style>
