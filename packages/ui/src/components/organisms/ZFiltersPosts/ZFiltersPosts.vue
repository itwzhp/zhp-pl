<template>
  <component
    :is="tag"
    class="z-filters-posts"
  >
    <ZDropdown
      name="Wybierz miesiąc"
      class="z-dropdown--has-chevron z-filters-post__date"
    />
    <ZDropdown
      name="Wybierz kategorie"
      class="z-dropdown--has-chevron z-filters-posts__categories"
    />
    <ZDropdown
      name="Wybierz tagi"
      class="z-dropdown--has-chevron z-filters-posts__tags"
      @update:open="update('selectedTags', selected.tags)"
    >
      <template #default="{ toggle }">
        <ZForm
          @submit.prevent="submit('tags', selectedTags, toggle)"
          @click:cancel="toggle"
        >
          <template>
            <ul class="z-filters-posts__tags-list">
              <template v-for="tag in tags">
                <li
                  :key="tag.id"
                  class="z-filters-posts__tag"
                >
                  <ZBubble
                    v-model="selectedTags"
                    :value="`${tag.id}`"
                    type="filter"
                    class="z-filters-post__bubble"
                  >
                    {{ tag.label }}
                  </ZBubble>
                </li>
              </template>
            </ul>
          </template>
        </ZForm>
      </template>
    </ZDropdown>
  </component>
</template>

<script>
import ZDropdown from '../../molecules/ZDropdown/ZDropdown.vue';
import ZForm from '../ZForm/ZForm.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';

export default {
  name: 'ZFiltersPosts',
  components: {
    ZDropdown,
    ZForm,
    ZBubble,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    tags: {
      type: Object,
      default: () => ({}),
    },
    selected: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      selectedTags: [],
    };
  },
  computed: {},
  methods: {
    update(fieldset, selected) {
      this[fieldset] = selected
        ? [...selected]
        : [];
    },
    submit(taxonomy, selected, toggle) {
      this.$emit('submit', { [taxonomy]: selected.join(',') });
      toggle();
    },
  },
};
</script>

<style lang="scss">
  .z-filters-posts {
    --button-text-transform: none;
    display: grid;
    grid-auto-flow: column;
    justify-content: left;
    align-items: center;

    &__date {

    }

    &__categories {
      @media (min-width: 480px) {
      }
    }

    &__tags {
      --button-min-width: 12rem;

      @media (min-width: 480px) {
      }
    }

    &__tags-list {
      display: flex;
      flex-wrap: wrap;
      padding: 0;
      margin: -3px -3px 10px -3px;
      list-style-type: none;
    }

    &__tag {
      margin: 3px;
    }

    &__bubble {
      --button-min-width: 14px;
      --button-padding: 0;
    }
  }
</style>
