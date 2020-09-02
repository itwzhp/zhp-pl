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
            :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${post.rest_media.file}`"
            :title="post.title.rendered"
            :to="post.link"
            :author="post.rest_author"
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
      <ZCard
        title="Polska reprezentacja na Jamboree 2019 w USA!"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12.jpg"
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
            <ZLink>400 harcerek i harcerzy wyruszyło do USA na Światowy Zlot Ska...</ZLink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <ZLink>Oferty pracy w warszawskim biurze Europejskiego Jamboree 2020</ZLink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <ZLink>Rekrutacja instruktorów do programu "Dobrze być sobą"</ZLink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <ZLink>Bezpieczne #harcerskielato</ZLink>
            <time datetime="18.08.2020">18.08.2020</time>
          </li>
          <li>
            <ZLink>Kielecki "Wiatraczek" znowu się kręci</ZLink>
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
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="19.05.202"
        style="grid-column: 10 / span 3;"
      />
    </div>
    <!-- Stopnie i sprawności -->
    <div
      style="display: grid;
      max-width: 1120px;
      align-items: end;
      margin: 90px auto;
      column-gap: 20px;
      grid-template-columns: repeat(24, 1fr);"
    >
      <ZCard
        title="Stopnie i sprawności"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/01.png"
        class="z-card--uppercase"
        style="grid-column: 2 / span 5; grid-template-rows: 360px 1fr;"
      />
      <ZCard
        title="Piony metodyczne"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/02.png"
        class="z-card--uppercase"
        style="grid-column: span 5; grid-template-rows: 376px 1fr;"
      />
      <ZCard
        title="Status ZHP i Władze ZHP"
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/03.png"
        class="z-card--uppercase"
        style="grid-column: span 5; grid-template-rows: 360px 1fr;"
      />
      <!-- CTA / BANNER-->
      <ZBanner
        title="Sprawdź Strefę Instruktora"
        content="Szukasz pomysłu na zajęcia? Inspiracji do pracy z harcerzami?"
        :call-to-actions="[{name: 'Przejdź do strony', href: '#'}]"
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
            :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${event.rest_media.file}`"
            :title="event.title.rendered"
            :date="{start: '01/09/2020', end: '03/09/2020'}"
            :location="{name: 'Warszawa'}"
            :audience="{name: 'Wszyscy harcerze'}"
            :type="{name: 'Zlot'}"
            :age-group="{name: 'Harcerze Starsi', color: '#ffffff', background: '#084da1'}"
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
        <ZCarousel
          v-if="partners.length > 0"
          :settings="{
            type: 'carousel',
            perView: 3,
            gap: 14,
            peek: { before: 0, after: 50 },
          }"
        >
          <li
            v-for="(partner, key) in partners"
            :key="key"
            class="glide__slide"
          >
            <ZImage
              :src="`https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/${partner}.png`"
            />
          </li>
        </ZCarousel>
        <ZHeading>Partnerzy wyjazdu na WSJ2019</ZHeading>
        <ZCarousel
          v-if="wsj2019Partners.length > 0"
          :settings="{
            type: 'carousel',
            perView: 3,
            gap: 14,
            peek: { before: 0, after: 50 },
          }"
        >
          <li
            v-for="(partner, key) in wsj2019Partners"
            :key="key"
            class="glide__slide"
          >
            <ZImage
              :src="`https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/${partner}.png`"
            />
          </li>
        </ZCarousel>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import {
  ZImage,
  ZSection,
  ZCarousel,
  ZArticle,
  ZEvent,
  ZCard,
  ZHeading,
  ZList,
  ZLink,
  ZBanner,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZImage,
    ZSection,
    ZCarousel,
    ZArticle,
    ZEvent,
    ZCard,
    ZHeading,
    ZList,
    ZLink,
    ZBanner,
  },
  data() {
    return {
      posts: [],
      events: [],
      partners: ['greenpeace', 'wwf', 'mop', 'ufs'],
      wsj2019Partners: ['mbank', 'wsb', 'brand', 'pko'],
    };
  },
  async created() {
    const { API_URL } = process.env;
    const params = {
      per_page: 8,
    };
    const postsRes = await axios.get(`${API_URL}/posts`, { params });
    this.posts = postsRes.data;
    const eventsRes = await axios.get(`${API_URL}/events`, { params });
    this.events = eventsRes.data;
  },
};
</script>
<style lang="scss">
  #home {}
</style>
