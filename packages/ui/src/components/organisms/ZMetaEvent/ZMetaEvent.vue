<template>
  <component
    :is="tag"
    class="z-meta-event"
  >
    <ZImage
      :src="thumbnail"
      class="z-meta-event__thumbnail"
    />
    <div class="z-meta-event__content">
      <div class="z-meta-event__calendar">
        <ZDate date="2020-06-20" />
        <div class="z-date__separator"></div>
        <ZDate date="2020-06-20" />
      </div>
      <ZLink>Warszawa</ZLink>
      <ZLink>Obóz</ZLink>
      <ZLink>Wszyscy harcerze</ZLink>
    </div>
  </component>
</template>

<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZDate from '../../atoms/ZDate/ZDate.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';

export default {
  name: 'ZMetaEvent',
  components: { ZImage, ZDate, ZLink },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    thumbnail: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="scss">
.z-meta-event {
  display: grid;
  overflow: hidden;
  min-height: 426px;
  border-radius: 10px;
  box-shadow: 0 2px 10px 0 rgba(157, 157, 157, 0.39);
  grid-auto-flow: row;

  &__thumbnail {
    display: flex;
    overflow: hidden;
    height: 396px;

    & .z-image,
    & img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }

  &__content {
    display: grid;
    align-items: center;
    justify-content: start;
    padding: 1.5rem;
    gap: 1rem;
    grid-auto-flow: column;

    @media (min-width: 480px) {
      gap: 0.5rem;
    }
  }

  &__calendar {
    --date-background: #f7f7f7;

    display: grid;
    gap: 0.25rem;
    grid-auto-flow: column;
    align-items: center;
  }
}
</style>
