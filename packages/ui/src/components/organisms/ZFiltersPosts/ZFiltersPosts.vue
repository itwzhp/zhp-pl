<template>
  <component
    :is="tag"
    class="z-filters-posts"
  >
    <div class="z-filters-posts__selectors">
      <ZDropdown
        name="Wybierz miesiąc"
        class="z-dropdown--has-chevron z-filters-post__date"
      />
      <ZDropdown
        name="Wybierz kategorie"
        class="z-dropdown--has-chevron z-filters-posts__categories"
        @update:open="updateCategories(selected, categories)"
      >
        <template #default="{ toggle }">
          <ZForm
            @submit="submit(selectedCategories, toggle)"
            @clik:cancel="toggle"
          >
            <template v-for="category in categories">
              <ZFormField
                :key="category.id"
                :label="category.label"
              >
                <template #input="{id}">
                  <ZSelect
                    :id="id"
                    v-model="selectedCategories[category.id]"
                    :options="category.options"
                  />
                </template>
              </ZFormField>
            </template>
          </ZForm>
        </template>
      </ZDropdown>
      <ZDropdown
        name="Wybierz tagi"
        class="z-dropdown--has-chevron z-filters-posts__tags"
        @update:open="updateTags(selected.tags)"
      >
        <template #default="{ toggle }">
          <ZForm
            @submit.prevent="submit({tags: selectedTags.join(',')}, toggle)"
            @click:cancel="toggle"
          >
            <template>
              <ul class="z-filters-posts__tags-list">
                <template v-for="option in tags">
                  <li
                    :key="option.id"
                    class="z-filters-posts__tag"
                  >
                    <ZBubble
                      v-model="selectedTags"
                      :value="`${option.id}`"
                      type="filter"
                      class="z-filters-post__bubble"
                    >
                      {{ option.label }}
                    </ZBubble>
                  </li>
                </template>
              </ul>
            </template>
          </ZForm>
        </template>
      </ZDropdown>
    </div>
    <ZList
      v-if="mapped.length > 0"
      class="z-filters-posts__selected"
    >
      <!-- date -->
      <template v-for="select in mapped">
        <li :key="select">
          <ZBubble
            :checked="true"
            type="filter"
            @change="unselect(taxonomies[select])"
          >
            {{ taxonomies[select] && taxonomies[select].label }}
          </ZBubble>
        </li>
      </template>
    </ZList>
  </component>
</template>

<script>
import ZDropdown from '../../molecules/ZDropdown/ZDropdown.vue';
import ZForm from '../ZForm/ZForm.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';
import ZFormField from '../../molecules/ZFormField/ZFormField.vue';
import ZSelect from '../../atoms/ZSelect/ZSelect.vue';
import ZList from '../ZList/ZList.vue';

export default {
  name: 'ZFiltersPosts',
  components: {
    ZDropdown,
    ZForm,
    ZBubble,
    ZFormField,
    ZSelect,
    ZList,
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
    categories: {
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
      selectedCategories: [],
    };
  },
  computed: {
    // TODO: keep all taxonomies as object with taxonomy name
    taxonomies() {
      return {
        ...this.tags,
        ...Object.keys(this.categories).reduce(
          (accumulator, category) => ({
            ...accumulator, ...this.categories[category].options,
          }), {},
        ),
      };
    },
    mapped() {
      return Object.keys(this.selected).reduce((accumulator, option) => {
        if (typeof this.selected[option] === 'object') {
          return [...accumulator, ...this.selected[option]];
        }
        return [...accumulator, this.selected[option]];
      }, []);
    },
  },
  methods: {
    updateCategories(selected, categories) {
      this.selectedCategories = Object.keys(categories).reduce((accumulator, category) => {
        if (selected[category]) {
          return { ...accumulator, [category]: selected[category] };
        }
        return accumulator;
      }, {});
    },
    updateTags(selected) {
      this.selectedTags = selected || [];
    },
    unselect(option) {
      let query;
      switch (option.taxonomy) {
        case 'tags':
          query = { [option.taxonomy]: this.selected.tags.filter((tag) => (tag !== option.value)).join(',') };
          break;
        default:
          query = {
            [option.taxonomy]: '',
          };
      }
      this.$emit('unselect', query);
    },
    submit(query, toggle) {
      this.$emit('submit', query);
      toggle();
    },
  },
};
</script>

<style lang="scss">
  .z-filters-posts {
    --button-text-transform: none;

    &__selectors {
      display: flex;
      justify-content: flex-start;
    }

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

    &__selected {
      display: flex;
      flex-wrap: wrap;
      justify-content: start;
      margin: 1rem -4px;

      & > * {
        margin: 4px;
      }
    }
  }
</style>
