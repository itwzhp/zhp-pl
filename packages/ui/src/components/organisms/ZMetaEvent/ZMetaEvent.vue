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
      <ZLink tag="span">
        {{ location.name }}
      </ZLink>
      <ZLink tag="span">
        {{ type.name }}
      </ZLink>
      <div>
        <template v-for="(audience, index) in audiences">
          <ZLink
            :key="audience.id"
            tag="span"
          >
            {{ audience.name }}{{ index < audiences.length - 1 ? `, ` : `` }}
          </ZLink>
        </template>
      </div>
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
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 10px 0 rgba(157, 157, 157, 0.39);
  grid-template-rows: 198px auto;

  @media (min-width: 640px) {
    grid-template-rows: 396px auto;
  }

  &__thumbnail {
    display: flex;
    overflow: hidden;

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
    grid-auto-flow: row;

    @media (min-width: 640px) {
      gap: 2.5rem;
      grid-auto-flow: column;
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
