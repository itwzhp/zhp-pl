<template>
  <div id="home">
    <!-- aktualności -->
    <ZSection
      title="Aktualności"
      subtitle="Zobacz, co nowego w ZHP"
    >
      <ZCarousel>
        <li
          v-for="(post, key) in posts"
          :key="key"
          class="glide__slide"
        >
          <ZCard
            :title="post.title"
            :author="post.author"
            :date="post.date"
            :to-link="post.toLink"
            :src-image="post.srcImage"
            :sources-image="post.sourcesImage"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- poznaj -->
    <ZSection>
      <ZBanner
        title="Poznaj ZHP"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempus euismod libero, et varius lorem
        rutrum ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
        Morbi in nibh luctus, fermentum arcu sit amet, tincidunt nisl. Maecenas malesuada nisl eu elit dignissim,
        et tempor odio feugiat."
      />
    </ZSection>
    <!-- zapisz -->
    <ZSection>
      <div>
        <ZBanner
          title="Chcesz zapisać swoje dziecko do harcerstwa?"
          content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempus euismod libero, et varius
          lorem rutrum ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
          Morbi in nibh luctus, fermentum arcu sit amet, tincidunt nisl. Maecenas malesuada nisl eu elit dignissim,
          et tempor odio feugiat."
          :call-to-actions="[
            {name: 'Jak zacząć?', to: '#'},
            {name: 'Ile kosztuje harcerstwo?', to: '#'},
            {name: 'Gdzie zacząć?', to: '#'}
          ]"
          src-image="https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png"
          :sources-image="[
            {
              srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png',
              media: '(min-width: 480px)',
              type: 'image/png'
            },
            {
              srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png'
            }
          ]"
        />
        <ZCard
          title="Przewodnicząca ZHP i Naczelnik ZHP: Wychowujemy w zgodzie z wartościami"
          src-image="https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png"
          :sources-image="[
            {
              srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png',
              media: '(min-width: 480px)',
              type: 'image/png'
            },
            {
              srcset: 'https://zhp.pl/wp-content/uploads/2020/06/News-podsumowanie-na-obozie-kopia-850x468.png'
            }
          ]"
        />
      </div>
    </ZSection>
    <!-- stopnie i sprawności | pion metodyczny | statut i władze zhp | przejdź do strony -->
    <!-- wydarzenia i przedsięwzięcia-->
    <ZSection
      title="Wydarzenia i przedsięwzięcia"
      subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempus euismod libero, et varius lorem
      rutrum ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. "
    >
      <ZCarousel>
        <li
          v-for="(post, key) in posts"
          :key="key"
          class="glide__slide"
        >
          <ZCard
            :title="post.title"
            :author="post.author"
            :date="post.date"
            :to-link="post.toLink"
            :src-image="post.srcImage"
            :sources-image="post.sourcesImage"
          />
        </li>
      </ZCarousel>
    </ZSection>
    <!-- #Instagram | Facebook | Partenrzy organizacji | Partnerzy wyjazdu na WSJ2019 -->
  </div>
</template>
<script>
import {
  ZSection, ZCarousel, ZCard, ZBanner,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZCard,
    ZSection,
    ZCarousel,
    ZBanner,
  },
  data() {
    return {
      posts: [
        {
          srcImage: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg',
          sourcesImage: [{ srcset: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg' }],
          toLink: '#',
          title: 'Szkolenie z RODO dla komisji rewizyjnych',
          author: { name: 'Marta Jeżak', to: '#' },
          date: '14.05.2020',
        },
        {
          srcImage: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg',
          sourcesImage: [{ srcset: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg' }],
          toLink: '#',
          title: 'Szkolenie z RODO dla komisji rewizyjnych',
          author: { name: 'Marta Jeżak', to: '#' },
          date: '14.05.2020',
        },
        {
          srcImage: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg',
          sourcesImage: [{ srcset: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg' }],
          toLink: '#',
          title: 'Szkolenie z RODO dla komisji rewizyjnych',
          author: { name: 'Marta Jeżak', to: '#' },
          date: '14.05.2020',
        },
        {
          srcImage: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg',
          sourcesImage: [{ srcset: 'https://zhp.pl/wp-content/uploads/2020/01/Weronika_Malachowska_ZHP_20180814BKK_2137-850x468.jpg' }],
          toLink: '#',
          title: 'Szkolenie z RODO dla komisji rewizyjnych',
          author: { name: 'Marta Jeżak', to: '#' },
          date: '14.05.2020',
        },
      ],
    };
  },
};
</script>
<style lang="scss">
  #home {}
</style>
