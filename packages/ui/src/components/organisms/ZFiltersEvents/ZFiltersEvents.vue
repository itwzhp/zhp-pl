<template>
  <component
    :is="tag"
    class="z-filters-events"
    style=" padding: 24px;
        border-radius: 10px;
        box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
        grid-row: span 3;
        place-self: start;"
  >
    <ZHeading
      :level="3"
      class="z-filters-events__title"
    >
      Filtry
    </ZHeading>
    <!-- todo: hide section for non selected filters-->
    <div
      class="z-filters-events__section"
    >
      <div class="z-filters-events__section-header">
        <ZHeading
          :level="4"
          class="z-filters-events__section-header-title"
        >
          Aktywne filtry
        </ZHeading>
      </div>
      <div class="z-filters-events__selected">
        <template v-for="(filters, taxonomy) in selectedBubbles">
          <template v-for="(filter, type) in filters">
            <ZBubble
              :key="filter.id"
              :value="true"
              type="filter"
              @input="removeSelectedFilter(filter, taxonomy, type)"
            >
              {{ filter.label }}
            </ZBubble>
          </template>
        </template>
      </div>
    </div>
    <ZForm @submit.prevent="submitFilters">
      <template #content>
        <div class="z-filters-events__section">
          <template v-for="(category, taxonomy) in categories">
            <ZFormField
              :key="category.id"
              :label="category.label"
            >
              <template #input="{id}">
                <ZSelect
                  :id="id"
                  :value="categorySelected(taxonomy)"
                  class="z-field__input"
                  :options="category.options"
                  @input="updateCategory($event, taxonomy)"
                />
              </template>
            </ZFormField>
          </template>
          <!-- todo: ACF integration -->
          <ZFormField label="Data Wydarzenia">
            <template #input>
              <ZDatePicker
                v-model="selectedDate"
                tag="input"
                :settings="{inline: false, dateFormat: 'd/m/Y'}"
                class="z-input"
              />
            </template>
          </ZFormField>
        </div>
        <div class="z-filters-events__section z-filters-events__section--no-border">
          <div class="z-filters-events__section-header">
            <ZHeading
              :level="4"
              class="z-filters-events__section-header-title"
            >
              Tagi
            </ZHeading>
            <ZLink
              to="#"
              class="z-filters-events__section-header-more"
            >
              Zobacz wszystkie
            </ZLink>
          </div>
          <!-- todo: add new field component the same like in WordPress tags  -->
          <ZFormField />
        </div>
      </template>
    </ZForm>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';
import ZSelect from '../../atoms/ZSelect/ZSelect.vue';
import ZInput from '../../atoms/ZInput/ZInput.vue';
import ZForm from '../ZForm/ZForm.vue';
import ZFormField from '../../molecules/ZFormField/ZFormField.vue';
import ZDatePicker from '../../atoms/ZDatePicker/ZDatePicker.vue';

export default {
  name: 'ZFiltersEvents',
  components: {
    ZDatePicker,
    ZLink,
    ZButton,
    ZBubble,
    ZIcon,
    ZText,
    ZHeading,
    ZSelect,
    ZInput,
    ZForm,
    ZFormField,
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
      default: 'form',
    },
    categories: {
      type: Object,
      default: () => ({}),
    },
    tags: {
      type: Object,
      default: () => ({}),
    },
    selectedFilters: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      selectedCategories: {},
      selectedTags: [],
      selectedDate: [],
    };
  },
  computed: {
    selectedBubbles() {
      const selectedBubbles = {};
      if (this.selectedFilters.date) {
        const date = this.selectedFilters.date.map((day) => (this.$options.filters.format(day))).join(' - ');
        selectedBubbles.date = { date: { id: '', value: this.selectedFilters.date, label: date } };
      }
      if (Object.keys(this.categories).length) {
        const selectedCategories = { ...this.selectedFilters.categories };
        Object.keys(selectedCategories).forEach((taxonomy) => {
          selectedCategories[taxonomy] = this.categories[taxonomy].options[selectedCategories[taxonomy]];
        });
        selectedBubbles.categories = selectedCategories;
      }
      if (Object.keys(this.tags).length) {
        const tags = this.selectedFilters.tags
            && this.selectedFilters.tags.map((option) => (this.tags[option]));
        selectedBubbles.tags = tags;
      }
      return selectedBubbles;
    },
  },
  methods: {
    categorySelected(taxonomy) {
      return this.selectedCategories[taxonomy];
    },
    updateCategory(id, taxonomy) {
      let categories = { ...this.selectedCategories };
      if (parseInt(id, 10)) {
        categories = { ...categories, [taxonomy]: parseInt(id, 10) };
      } else {
        delete categories[taxonomy];
      }
      this.selectedCategories = categories;
    },
    submitFilters() {
      const selectedFilters = {};
      if (Object.keys(this.selectedCategories)) {
        selectedFilters.categories = { ...this.selectedCategories };
      }
      if (this.selectedDate.length === 2) {
        selectedFilters.date = [...this.selectedDate];
      }
      if (this.selectedTags.length > 0) {
        selectedFilters.tags = [...this.selectedTags];
      }
      this.$emit('submit', selectedFilters);
    },
    unchecked(state) {
      return state;
    },
    removeSelectedFilter(filter, taxonomy, category) {
      const selectedFilters = { ...this.selectedFilters };
      switch (taxonomy) {
        case 'categories':
          delete selectedFilters.categories[category];
          break;
        case 'date':
          delete selectedFilters.date;
          break;
        default:
          selectedFilters.tags = selectedFilters.tags.filter((tag) => (tag !== filter.value));
      }
      this.$emit('update', selectedFilters);
    },
  },
};
</script>

<style lang="scss">
  .z-filters-events {
    &__title {
      margin: 0 0 8px 0;
    }

    &__section {
      padding: 0 0 24px 0;
      border: solid #eae5f0;
      border-width: 0 0 2px 0;
      margin: 0 0 24px 0;

      &-header {
        display: grid;
        align-items: center;
        justify-content: space-between;
        margin: 16px 0;
        grid-template-columns: repeat(2, auto);

        &-title {
          text-transform: uppercase;
        }

        &-more {
          color: #7ba22e;
        }
      }

      &--no-border {
        padding: 0;
        border-width: 0;
        margin: 0;
      }
    }

    &__selected {
      display: flex;
      flex-wrap: wrap;
      justify-content: start;
      margin: 24px 0;
      gap: 8px;
    }
  }
</style>
