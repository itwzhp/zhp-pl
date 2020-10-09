<template>
  <div id="home">
    <ZSection class="hero">
      <ZHeading
        :level="1"
        class="hero__title"
      >
        Przygoda.
        Przyjaźń.
        Wychowanie.
      </ZHeading>
      <form class="z-search hero__search">
        <ZInput
          type="text"
          placeholder="Czego dzisiaj chcsz się dowiedzieć o ZHP?"
          class="z-search__input"
        />
        <ZButton
          style="--button-min-width: 168px;"
          class="z-search__submit"
        >
          <ZIcon
            name="search"
            class="z-search__icon"
          />
          Wyszukaj
        </ZButton>
      </form>
    </ZSection>
    <ZSection
      title="Aktualności"
      subtitle="Zobacz, co nowego w ZHP"
    >
      <ZCarousel
        v-if="posts.length > 0"
        :peeked="true"
        :settings="{
          type: 'carousel',
          perView: 4,
          gap: 20,
          autoplay: 3000,
          breakpoints: {
            480: {
              perView: 1
            }
          }
        }"
        class="z-carousel--peeked carousel"
      >
        <li
          v-for="post in posts"
          :key="post.id"
          class="glide__slide"
        >
          <ZPost
            :key="post.id"
            :thumbnail="post.rest_media"
            :title="post.title.rendered"
            :to="`/posts/${post.slug}`"
            :author="post.rest_author"
            :sticky="post.sticky"
            :date="post.date"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <ZSection class="highlighted">
      <ZCard
        title="Polska reprezentacja na Jamboree 2019 w USA!"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        class="highlighted__post"
      />
      <ZHighlighted
        title="Warto przeczytać"
        :more="{title: 'Zobacz więcej', href: '#'}"
        :posts="highlightedPosts"
        class="highlighted__posts"
      />
    </ZSection>
    <ZSection
      style="--section-content-max-width: 1235px;"
    >
      <ZBanner
        title="Poznaj ZHP"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        class="meet"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/news-DMB.png"
        cover-type="video"
      />
    </ZSection>
    <ZSection class="enjoy">
      <ZBanner
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        :calls-to-action="[
          {name:'Jak zacząć', href: '#'},
          {name:'Ile kosztuje harcerstwo?', href: '#'},
          {name:'Gdzie się zapisać?', href: '#'}]"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/Agnieszka_Madetko-Kurczab_ZHP_21-scaled.jpg"
        class="enjoy__banner"
      />
      <ZPost
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="2020-08-30T08:30:31"
        class="enjoy__post"
      />
    </ZSection>
    <ZSection
      class="instructor"
    >
      <ZCard
        title="Stopnie i sprawności"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/01.png"
        class="instructor__rank"
      />
      <ZCard
        title="Piony metodyczne"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/02.png"
        class="instructor__age-groups"
      />
      <ZCard
        title="Status ZHP i Władze ZHP"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/03.png"
        class="instructor__management"
      />
      <ZBanner
        title="Sprawdź Strefę Instruktora"
        content="Szukasz pomysłu na zajęcia? Inspiracji do pracy z harcerzami?"
        :calls-to-action="{name: 'Przejdź do strony', href: '#'}"
        class="instructor__zone"
      />
    </ZSection>
    <ZSection
      title="Wydarzenia i przedsięwzięcia"
      subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus sagittis,
      ultrices consectetur turpis."
    >
      <ZCarousel
        v-if="events.length > 0"
        :settings="{
          type: 'carousel',
          perView: 4,
          gap: 20,
          autoplay: 3000,
          breakpoints: {
            480: {
              perView: 1
            }
          }
        }"
        :peeked="true"
        class="z-carousel--peeked carousel"
      >
        <li
          v-for="event in events"
          :key="event.id"
          class="glide__slide"
        >
          <ZEvent
            :key="event.id"
            :thumbnail="event.rest_media"
            :title="event.title.rendered"
            :date="event.rest_acf.date"
            :location="{name: 'Warszawa'}"
            :audience="{name: 'Wszyscy harcerze'}"
            :type="event.rest_event_type"
            :age-group="event.rest_age_group"
            :to="`/events/${event.slug}`"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- #instagram | facebook | organization partners  -->
  </div>
</template>

<script>
import {
  ZSection,
  ZHeading,
  ZInput,
  ZButton,
  ZBanner,
  ZCarousel,
  ZPost,
  ZCard,
  ZHighlighted,
  ZEvent,
  ZIcon
} from '@nowa-zhp/ui'

export default {
  name: 'Home',
  components: {
    ZSection,
    ZHeading,
    ZInput,
    ZButton,
    ZBanner,
    ZCarousel,
    ZPost,
    ZCard,
    ZHighlighted,
    ZEvent,
    ZIcon
  },
  async asyncData ({ $axios }) {
    // last 8 post for posts ZCarousel
    const postsRes = await $axios.get('posts', { per_page: 8 })
    const posts = postsRes.data
    // last 5 posts for ZHighlighted component
    const highlightedPostsRes = await $axios.get('posts', { per_page: 5 })
    const highlightedPosts = highlightedPostsRes.data.map(post => ({ ...post, title: post.title.rendered }))
    // last 8 events for events ZCarousel
    const eventsRes = await $axios.get('events', { per_page: 8 })
    const events = eventsRes.data

    return { posts, highlightedPosts, events }
  }
}
</script>

<style lang="scss">
#home {
  overflow: hidden;

  .hero {
    &__title {
      margin: 24px 0;
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: 6 / span 4;
        grid-row: 1;
      }
    }

    &__search {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: 6 / span 6;
        grid-row: 2;
      }
    }
  }

  .carousel {
    grid-column: span 12;
  }

  .meet {
    --banner-content-padding: 64px;
    --banner-description-grid-column: span 5;
    --banner-title-grid-column: span 5;

    grid-column: span 12;
  }

  .highlighted {
    --section-content-align-items: center;

    &__post {
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

  .enjoy {
    &__banner {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 9;
      }
    }

    &__post {
      --post-grid-template-rows: 1fr auto;
      --article-meta-order: -1;

      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 3;
      }
    }
  }

  .instructor {
    --section-content-align-items: end;

    @media (min-width: 480px) {
      --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
    }

    &__rank,
    &__management,
    &__age-groups,
    &__zone {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 5;
      }
    }

    &__age-groups {
      @media (min-width: 480px) {
        height: calc(100% + 2rem);
        transform: translateY(16px);
      }
    }

    &__zone {
      --banner-title-margin: 0 0 32px 0;
      --banner-description-grid-row: 1;
      --banner-description-grid-column: span 12;
      --banner-title-grid-column: span 12;
      --banner-cta-grid-column: span 12;
      --banner-title-grid-row: 2;
      --banner-title-text-transform: normal;
      --banner-background: linear-gradient(135deg, rgba(123, 162, 46, 1) 8%, rgba(166, 206, 57, 1) 70%);
    }
  }

  .social {
    &__instagram,
    &__facebook,
    &__partners {
      grid-column: span 12;
    }

    &__instagram {
      @media (min-width: 480px) {
        grid-column: span 4;
      }
    }

    &__facebook {
      @media (min-width: 480px) {
        grid-column: span 3;
      }
    }

    &__partners {
      @media (min-width: 480px) {
        grid-column: span 5;
      }
    }
  }
}

.z-search {
  display: grid;
  grid-row-gap: 16px;
  justify-items: end;

  &__input {
    --input-background: #a6ce39;
    --input-color: #fff;

    width: 100%;
  }

  &__icon {
    --icon-color: #fff;

    margin: 0 8px 0 0;
  }
}
</style>
