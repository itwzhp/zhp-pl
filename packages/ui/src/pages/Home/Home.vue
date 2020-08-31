<template>
  <div id="home">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <ZHeading style="grid-column: 6 / span 1;">
        Przygoda.
        Przyjaźń.
        Wychowanie.
      </ZHeading>
      <!-- Czego dzisiaj chcesz się dowiedzieć o ZHP? ZSearch -->
    </div>
    <!-- Aktualności -->
    <ZSection
      title="Aktualności"
      subtitle="Zobacz, co nowego w ZHP"
      style="margin: 90px auto;"
    >
      <ZCarousel v-if="posts.length > 0">
        <li
          v-for="post in posts"
          :key="post.id"
          class="glide__slide"
        >
          <ZArticle
            :key="post.id"
            :thumbnail="post.futured_media"
            :title="post.title.rendered"
            :to="post.link"
            :author="post.author"
            :sticky="post.sticky"
            :date="post.date"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- Warto przeczytać -->
    <div
      style="display: grid;
    max-width: 1120px;
    margin: 90px auto;
    column-gap: 20px;
    grid-template-columns: repeat(12, 1fr);"
    >
      <ZArticle
        title="Polska reprezentacja na Jamboree 2019 w USA!"
        thumbnail="http://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        style="grid-column: span 4;"
      />
      <div
        class="z-highlighted"
        style="grid-column: span 7;"
      >
        <ZHeading>Warto przeczytać</ZHeading>
        <ZLink>Zobacz więcej</ZLink>
        <ZList>
          <li>
            <Zlink>400 harcerek i harcerzy wyruszyło do USA na Światowy Zlot Ska...</Zlink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <Zlink>Oferty pracy w warszawskim biurze Europejskiego Jamboree 2020</Zlink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <Zlink>Rekrutacja instruktorów do programu "Dobrze być sobą"</Zlink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <Zlink>Bezpieczne #harcerskielato</Zlink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <Zlink>Kielecki "Wiatraczek" znowu się kręci</Zlink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
        </ZList>
      </div>
    </div>
    <!-- Poznaj ZHP -->
    <!-- Chcesz zapisać swoje dziecko do harcerstwa -->
    <div
      style="display: grid;
      max-width: 1120px;
      margin: 90px auto;
      column-gap: 20px;
      grid-template-columns: repeat(12, 1fr);"
    >
      <ZBanner
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Gromada zuchowa, drużyna harcerska, starszoharcerska, wędrownicza to doskonałe  miejsce aktywności
          dzieci i młodzieży. W drużynach dzieci i młodzież przygotowują się do aktywnego, dorosłego życia. Przez
          szkołę harcerską przeszło wiele znanych i cenionych osób, zajmujących dzisiaj ważne stanowiska w życiu
          społecznym, gospodarczym i politycznym. Harcerska szkoła życia i harcerski system wychowawczy odciska trwałe,
          pozytywne  piętno na młodych ludziach i procentuje na całe dorosłe życie."
        style="grid-column: span 9;"
      />
      <ZArticle
        thumbnail="http://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="19.05.202"
        style="grid-column: 10 / span 3;"
      />
    </div>
    <!-- Stopnie i sprawności -->
    <div
      style="display: grid;
      max-width: 1120px;
      margin: 90px auto;
      column-gap: 20px;
      grid-template-columns: repeat(24, 1fr);"
    >
      <ZArticle
        title="Stopnie i sprawności"
        thumbnail="http://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        style="grid-column: 2 / span 5;"
      />
      <ZArticle
        title="Piony metodyczne"
        thumbnail="http://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        style="grid-column: span 5;"
      />
      <ZArticle
        title="Status ZHP i Władze ZHP"
        thumbnail="http://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        style="grid-column: span 5;"
      />
      <!-- CTA / BANNER-->
      <ZArticle
        title="Sprawdź strefę instrukotra"
        thumbnail="http://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
        style="grid-column: span 5;"
      />
    </div>
    <!-- Wydarzenia -->
    <ZSection
      title="Wydarzenia i przedsięwzięcia"
      subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempus euismod libero, et varius lorem
      rutrum ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. "
      style="margin: 90px auto;"
    >
      <ZCarousel v-if="events.length > 0">
        <li
          v-for="event in events"
          :key="event.id"
          class="glide__slide"
        >
          <ZEvent
            :key="event.id"
            :thumbnail="event.futured_media"
            :title="event.title.rendered"
            :date="event.acf.date"
            :location="{name: 'Warszawa'}"
            :audience="{name: 'Wszyscy harcerze'}"
            :type="eventTypes[event.eventTypes]"
            :age-group="ageGroups[event.ageGroups]"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- Instagram, Facebook, Partnerzy -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <div
        class="instagram"
        style="grid-column: span 4;"
      >
        <ZHeading>#instagram</ZHeading>
      </div>
      <div
        class="facebook"
        style="grid-column: span 3;"
      >
        <ZHeading>facebook</ZHeading>
      </div>
      <div
        class="partners"
        style="grid-column: span 5;"
      >
        <ZHeading>Partnerzy organizacji</ZHeading>
        <ZHeading>Partnerzy wyjazdu na WSJ2019</ZHeading>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import {
  ZSection, ZCarousel, ZArticle, ZEvent, ZHeading, ZList, ZLink, ZBanner,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZSection,
    ZCarousel,
    ZArticle,
    ZEvent,
    ZHeading,
    ZList,
    ZLink,
    ZBanner,
  },
  data() {
    return {
      posts: [],
      events: [],
      eventTypes: [],
      ageGroups: [],
    };
  },
  async mounted() {
    const { API_URL } = process.env;
    const usersResponse = await axios.get(`${API_URL}/users`);
    const users = usersResponse.data.reduce((accumulator, user) => ({
      ...accumulator,
      [user.id]: {
        name: user.name,
        to: user.link,
      },
    }), {});
    const postsResponse = await axios.get(`${API_URL}/posts?per_page=6`);
    const posts = postsResponse.data;
    const postsWithMedia = await Promise.all(posts.map(async (post) => {
      const mediaResponse = await axios.get(`${API_URL}/media/${post.featured_media}`);
      const media = mediaResponse.data;
      return { ...post, futured_media: media.guid.rendered };
    }));
    const postsWithAuthors = postsWithMedia.map((post) => ({ ...post, author: users[post.author] }));
    this.posts = postsWithAuthors;
    const ageGroupsResponse = await axios.get(`${API_URL}/ageGroups`);
    const ageGroups = ageGroupsResponse.data.reduce((accumulator, methodology) => ({
      ...accumulator,
      [methodology.id]: {
        name: methodology.name,
        background: methodology.acf.background,
        color: methodology.acf.color,
      },
    }), {});
    this.ageGroups = ageGroups;
    const eventTypesResponse = await axios.get(`${API_URL}/eventTypes`);
    const eventTypes = eventTypesResponse.data.reduce((accumulator, type) => ({
      ...accumulator,
      [type.id]: { name: type.name },
    }), {});
    this.eventTypes = eventTypes;
    const eventsResponse = await axios.get(`${API_URL}/events?per_page=6`);
    const events = eventsResponse.data;
    const eventsWithMedia = await Promise.all(events.map(async (event) => {
      const mediaResponse = await axios.get(`${API_URL}/media/${event.featured_media}`);
      const media = mediaResponse.data;
      return { ...event, futured_media: media.guid.rendered };
    }));
    this.events = eventsWithMedia;
  },
};
</script>
<style lang="scss">
  #home {}
</style>
