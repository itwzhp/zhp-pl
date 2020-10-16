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
        <ZDate :date="date.begin" />
        <div class="z-date__separator" />
        <ZDate :date="date.end" />
      </div>
      <ZLink to="#">
        {{ location.name }}
      </ZLink>
      <ZLink to="#">
        {{ type.name }}
      </ZLink>
      <template v-for="audience in audiences">
        <ZLink
          :key="audience.id"
          to="#"
        >
          {{ audience.name }}
        </ZLink>
      </template>
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
    date: {
      type: Object,
      default: () => ({
        begin: '',
        end: '',
      }),
    },
    location: {
      type: Object,
      default: () => ({
        name: '',
      }),
    },
    type: {
      type: Object,
      default: () => ({
        name: '',
      }),
    },
    audiences: {
      type: Array,
      default: () => ([]),
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
    gap: 0.5rem;
    grid-auto-flow: column;

    @media (min-width: 480px) {
      gap: 2.5rem;
    }
  }

  &__calendar {
    --date-background: #f7f7f7;

    display: grid;
    align-items: center;
    gap: 0.25rem;
    grid-auto-flow: column;
  }
}
</style>
