<template>
  <div id="home">
    <ZSection class="section-hero">
      <div class="section-hero__picture" />
      <ZHeading :level="1" class="section-hero__title t3">
        Przygoda. Przyjaźń. Wychowanie
      </ZHeading>
      <ZSearch class="section-hero__search" />
    </ZSection>
    <ZSection
      title="Aktualności"
      subtitle="Zobacz, co nowego w ZHP"
    >
      <ZCarousel
        v-if="posts.length > 0"
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
        class="carousel"
      >
        <template v-for="post in posts">
          <li
            :key="post.id"
            class="glide__slide"
          >
            <ZPost
              :thumbnail="post.rest_media"
              :title="post.title && post.title.rendered"
              :to="`/posts/${post.slug}`"
              :author="post.rest_author"
              :date="post.date"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
    <ZSection class="section-highlighted">
      <ZCard
        title="Polska reprezentacja na Jamboree 2019 w USA!"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        class="section-highlighted__card"
      />
      <ZHighlighted
        title="Warto przeczytać"
        :more="{title: 'Zobacz więce', to:'/posts'}"
        :posts="highlightedPosts"
        class="section-highlighted__posts"
      />
    </ZSection>
    <ZSection class="section-join-us">
      <ZBanner
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/Agnieszka_Madetko-Kurczab_ZHP_21-scaled.jpg"
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        :calls-to-action="[
          {name:'Jak zacząć', to: '/jak-zaczac'},
          {name:'Ile kosztuje harcerstwo?', to: '/ile-kosztuje-harcerstwo'},
          {name:'Gdzie się zapisać?', to: '/gdzie-sie-zapisac'}]"
        class="section-join-us__banner"
      />
      <ZPost
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="2020-08-30"
        class="section-join-us__post"
      />
    </ZSection>
    <ZSection
      title="Wydarzenia i przedsięwzięcia"
      subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus sagittis,
      ultrices consectetur turpis."
    >
      <ZCarousel
        v-if="events.length > 0"
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
              :to="`/events/${event.slug}`"
              :author="event.rest_author"
              :date="event.rest_acf.date"
              :location="{name: 'Warszawa'}"
              :audience="{name: 'Wszyscy harcerze'}"
              :type="event.rest_event_type"
              :age-group="event.rest_age_group"
            />
          </li>
        </template>
      </ZCarousel>
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
  ZSection
} from '@nowa-zhp/ui'

export default {
  name: 'Home',
  components: {
    ZBanner,
    ZCard,
    ZCarousel,
    ZEvent,
    ZHeading,
    ZHighlighted,
    ZPost,
    ZSearch,
    ZSection
  },
  async asyncData ({ $axios }) {
    // last 8 post for posts ZCarousel
    const postsRes = await $axios.get('posts', { params: { per_page: 8 } })
    const posts = postsRes.data
    // last 5 posts for ZHighlighted component
    const highlightedPostsRes = await $axios.get('posts', { params: { per_page: 5 } })
    const highlightedPosts = highlightedPostsRes.data.map(post => ({ ...post, title: post.title.rendered }))
    // last 8 events for events ZCarousel
    const eventsRes = await $axios.get('events', { params: { per_page: 8 } })
    const events = eventsRes.data

    return { posts, highlightedPosts, events }
  }
}
</script>

<style lang="scss">
#home {
  overflow: hidden;

  .section-hero {
    &__picture {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 6;
        grid-row: span 2;
      }
    }

    &__title {
      margin: 0 0 1.5rem 0;
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 4;
      }
    }

    &__search {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 6;
      }
    }
  }

  .section-highlighted {
    --section-content-align-items: center;

    &__card {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 4;
      }
    }

    &__posts {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 7;
      }
    }
  }

  .section-join-us {
    &__banner {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 9;
      }
    }

    &__post {
      --post-grid-template-rows: 1fr auto;
      --post-meta-order: -1;

      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 3;
      }
    }
  }

  .carousel {
    grid-column: span 12;
  }
}
</style>
