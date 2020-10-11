<template>
  <component
    :is="tag"
    class="z-files"
  >
    <ZHeading
      :level="2"
      class="z-files__title body-1"
    >
      {{ title }}
    </ZHeading>
    <ZList class="z-files__files">
      <template v-for="(file, key) in files">
        <li :key="key">
          <div class="z-file">
            <div class="z-file__type caption">
              {{ file.type }}
            </div>
            <ZLink
              :to="file.to"
              class="z-file__name t6"
            >
              {{ file.name }}
            </ZLink>
            <div
              v-if="file.mimeType || file.date"
              class="z-file__meta"
            >
              {{ file.mimeType }}, {{ file.date }}
            </div>
          </div>
        </li>
      </template>
    </ZList>
  </component>
</template>

<script>
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZList from '../../organisms/ZList/ZList.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';

export default {
  name: 'ZFiles',
  components: { ZHeading, ZList, ZLink },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    title: {
      type: String,
      default: '',
    },
    files: {
      type: Array,
      default: () => ([]),
    },
  },
};
</script>

<style lang="scss">
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
  }

  &__meta {
    color: #a6ce39;
  }
}
</style>
