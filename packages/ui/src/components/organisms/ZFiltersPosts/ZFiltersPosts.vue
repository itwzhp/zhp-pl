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
            Wybierz datę
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
        class="z-dropdown--has-chevron z-filters-posts__categories"
        @update:open="updateCategories(selected.categories)"
      >
        <template #toggle="{ toggle }">
          <ZButton
            class="z-dropdown__toggle z-filters-posts__categories-toggle"
            @click="toggle"
          >
            Wybierz kategorię
          </ZButton>
        </template>
        <template #default="{ toggle }">
          <ZForm
            @submit.prevent="submit({categories: selectedCategories.join(',')}, toggle)"
            @click:cancel="toggle"
          >
            <template>
              <ul class="z-filters-posts__categories-list">
                <template v-for="option in categories">
                  <li
                    :key="option.id"
                    class="z-filters-posts__category"
                  >
                    <ZBubble
                      v-model="selectedCategories"
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
      <template v-if="mappedDate.length === 2">
        <li>
          <ZBubble
            :checked="true"
            type="filter"
            @change="unselectDate"
          >
            {{ mappedDate.join(' - ') }}
          </ZBubble>
        </li>
      </template>
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
      selectedCategories: [],
      selectedDate: [],
    };
  },
  computed: {
    // TODO: keep all taxonomies as object with taxonomy name
    taxonomies() {
      return {
        ...this.categories,
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
    updateCategories(selected) {
      this.selectedTags = selected || [];
    },
    unselectDate() {
      this.$emit('submit', { after: '', before: '' });
    },
    unselectTaxonomies(option) {
      let query;
      switch (option.taxonomy) {
        case 'categories':
          query = { [option.taxonomy]: this.selected.categories.filter((category) => (category !== option.value)).join(',') };
          break;
        default:
          query = {
            [option.taxonomy]: '',
          };
      }
      this.$emit('submit', query);
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
      display: grid;
      grid-template-columns: minmax(auto, 1fr);
      gap: .5rem;
      @media (min-width: 480px) {
        gap: 0;
        grid-template-columns: repeat(2, minmax(auto, 1fr));
      }
    }

    &__date {
      @media (min-width: 480px) {
        --dropdown-content-width: 200%;
        --button-min-width: 100%;
      }
    }

    &__date-toggle {
      --button-height: 40px;
      @media (min-width: 480px) {
        --button-border-radius: 0.625rem 0 0 0.625rem;
      }
    }

    &__date-picker {
      display: grid;
      align-items: end;
      grid-template-columns: minmax(auto, 1fr);
      @media (min-width: 480px) {
        grid-template-columns: auto 180px;
      }

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
      grid-column: 1;
      grid-template-rows: auto 3.25rem;
      @media (min-width: 480px) {
        grid-column: 2;
      }
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
        --button-min-width: 100%;

        margin: 0 0 0 -0.625rem;
      }
    }

    &__categories-toggle {
      --button-background: #4a7b26;
      --button-height: 40px;
    }

    &__categories-list {
      display: flex;
      flex-wrap: wrap;
      padding: 0;
      margin: -3px -3px 10px -3px;
      list-style-type: none;
    }

    &__category {
      margin: 3px;
    }

    &__bubble {
      --button-min-width: 14px;
      --button-padding: 0;
    }

    &__selected {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      margin: 1rem -4px;

      & > * {
        margin: 4px;
      }
    }
  }
</style>
