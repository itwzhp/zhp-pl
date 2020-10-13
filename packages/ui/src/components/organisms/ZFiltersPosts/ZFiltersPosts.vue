<template>
  <component
    :is="tag"
    class="z-filters-posts"
  >
    <div class="z-filters-posts__selectors">
      <ZDropdown
        class="z-dropdown--has-chevron z-filters-posts__date"
        @update:open="updateDate(selected)"
      >
        <template #toggle="{ toggle }">
          <ZButton
            class="z-dropdown__toggle z-filters-posts__date-toggle"
            @click="toggle"
          >
            Wybierz miesiąc
          </ZButton>
        </template>
        <template #default="{ toggle }">
          <ZForm
            @submit="submit({after: selectedDate[0], before: selectedDate[1]}, toggle)"
            @click:cancel="toggle"
          >
            <div class="z-filters-posts__date-picker">
              <ZDatePicker v-model="selectedDate" />
              <div class="z-filters-posts__date-selected">
                <ZText class="z-filters-posts__date-label">
                  Wybrana data
                </ZText>
                <div class="z-filters-posts__date-value">
                  <template v-if="selectedDate.length === 2">
                    <ZText tag="div">
                      {{ selectedDate[0] | format }}
                    </ZText>
                    <ZText tag="div">
                      -
                    </ZText>
                    <ZText tag="div">
                      {{ selectedDate[1] | format }}
                    </ZText>
                  </template>
                  <template v-else>
                    Nie wybrano żadnej daty
                  </template>
                </div>
              </div>
            </div>
          </ZForm>
        </template>
      </ZDropdown>
      <ZDropdown
        name="Wybierz kategorie"
        class="z-dropdown--has-chevron z-filters-posts__categories"
        @update:open="updateCategories(selected, categories)"
      >
        <template #toggle="{ toggle }">
          <ZButton
            class="z-dropdown__toggle z-filters-posts__categories-toggle"
            @click="toggle"
          >
            Wybierz miesiąc
          </ZButton>
        </template>
        <template #default="{ toggle }">
          <ZForm
            @submit="submit(selectedCategories, toggle)"
            @click:cancel="toggle"
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
        class="z-dropdown--has-chevron z-filters-posts__tags"
        @update:open="updateTags(selected.tags)"
      >
        <template #toggle="{ toggle }">
          <ZButton
            class="z-dropdown__toggle z-filters-posts__tags-toggle"
            @click="toggle"
          >
            Wybierz tagi
          </ZButton>
        </template>
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
      v-if="mappedDate.length === 2 || mappedTaxonomies.length > 0"
      class="z-filters-posts__selected"
    >
      <li v-if="mappedDate.length === 2">
        <ZBubble
          :checked="true"
          type="filter"
          @change="unselectDate"
        >
          {{ mappedDate.join(' - ') }}
        </ZBubble>
      </li>
      <template v-for="select in mappedTaxonomies">
        <li :key="select">
          <ZBubble
            :checked="true"
            type="filter"
            @change="unselectTaxonomies(taxonomies[select])"
          >
            {{ taxonomies[select] && taxonomies[select].label }}
          </ZBubble>
        </li>
      </template>
    </ZList>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZDropdown from '../../molecules/ZDropdown/ZDropdown.vue';
import ZForm from '../ZForm/ZForm.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';
import ZFormField from '../../molecules/ZFormField/ZFormField.vue';
import ZSelect from '../../atoms/ZSelect/ZSelect.vue';
import ZList from '../ZList/ZList.vue';
import ZDatePicker from '../../molecules/ZDatePicker/ZDatePicker.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';

export default {
  name: 'ZFiltersPosts',
  components: {
    ZText,
    ZDatePicker,
    ZDropdown,
    ZForm,
    ZBubble,
    ZFormField,
    ZSelect,
    ZList,
    ZButton,
  },
  filters: {
    format(date) {
      if (!date) {
        return '';
      }
      return format(new Date(date), 'dd/MM/yyyy');
    },
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
      selectedDate: [],
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
    mappedDate() {
      const after = this.selected && this.$options.filters.format(this.selected.after);
      const before = this.selected && this.$options.filters.format(this.selected.before);

      return [after, before].filter((date) => (date));
    },
    mappedTaxonomies() {
      const exclude = ['after', 'before'];
      return Object.keys(this.selected).reduce((accumulator, option) => {
        if (typeof this.selected[option] === 'object') {
          return [...accumulator, ...this.selected[option]];
        }
        return exclude.includes(option) ? accumulator : [...accumulator, this.selected[option]];
      }, []);
    },
  },
  methods: {
    updateDate(selected) {
      this.selectedDate = [selected.after, selected.before].filter((date) => (date));
    },
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
    unselectDate() {
      this.$emit('unselect', { after: '', before: '' });
    },
    unselectTaxonomies(option) {
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
      flex-wrap: wrap;
      justify-content: flex-start;
    }

    &__date {
      @media (min-width: 480px) {
        --dropdown-content-width: calc(300% - 0.75rem);
      }
    }

    &__date-toggle {
      @media (min-width: 480px) {
        --button-height: 40px;
        --button-border-radius: 0.625rem 0 0 0.625rem;
      }
    }

    &__date-picker {
      display: grid;
      align-items: end;
      grid-template-columns: auto 180px;

      .flatpickr-calendar {
        grid-column: 1;
      }
    }

    &__date-selected {
      display: grid;
      justify-content: center;
      padding: 1rem;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.05);
      font-size: var(--font-size-body-2);
      grid-column: 2;
      grid-template-rows: auto 3.25rem;
    }

    &__date-label {
      font-weight: 900;
      text-transform: uppercase;
    }

    &__date-value {
      display: grid;
      align-items: center;
      grid-auto-flow: row;
      justify-items: center;
    }

    &__categories {
      @media (min-width: 480px) {
        --dropdown-content-width: calc(200% - 0.125rem);

        margin: 0 0 0 -0.625rem;
      }
    }

    &__categories-toggle {
      --button-background: #78a22f;

      @media (min-width: 480px) {
        --button-height: 40px;
        --button-border-radius: 0.625rem 0 0 0.625rem;
      }
    }

    &__tags {
      @media (min-width: 480px) {
        --button-height: 40px;
        --button-min-width: 12rem;

        margin: 0 0 0 -0.625rem;
      }
    }

    &__tags-toggle {
      --button-background: #4a7b26;
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
