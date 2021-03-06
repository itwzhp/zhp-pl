<template>
  <component
    :is="tag"
    class="z-filters-events"
  >
    <ZHeading
      :level="3"
      class="z-filters-events__title t6 uppercase"
    >
      Filtry
    </ZHeading>
    <div class="z-filters-events__section">
      <div
        v-if="mappedDate.length === 2 || mappedTaxonomies.length > 0"
        class="z-filters-events__section-header"
      >
        <ZHeading
          :level="4"
          class="uppercase z-filters-events__section-title"
        >
          Aktywne filtry
        </ZHeading>
      </div>
      <ZList
        v-if="mappedDate.length === 2 || mappedTaxonomies.length > 0"
        class="z-filters-events__selected"
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
        <template
          v-for="select in mappedTaxonomies"
        >
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
    </div>
    <ZForm
      @submit.prevent="submit"
      @click:cancel="clear"
    >
      <template>
        <template v-for="category in categories">
          <ZFormField
            :key="category.id"
            :label="category.label"
          >
            <template #input="{id}">
              <ZSelect
                :id="id"
                :multiple="true"
                size="5"
                :value="selectedCategories[category.id] || []"
                :options="category.options"
                class="z-form-field__input"
                @input="selectHandler(category.id, $event)"
              />
            </template>
          </ZFormField>
        </template>
        <!-- TODO: include it to API request; ACF integration -->
        <ZFormField
          label="Kiedy"
        >
          <template #input>
            <ZDatePicker
              v-model="selectedDate"
              tag="input"
              placeholder="Wybierz przedział"
              :settings="{
                inline: false,
                dateFormat: 'd/m/Y',
                maxDate: null
              }"
              class="z-input"
            />
          </template>
        </ZFormField>
      </template>
    </ZForm>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZList from '../ZList/ZList.vue';
import ZForm from '../ZForm/ZForm.vue';
import ZFormField from '../../molecules/ZFormField/ZFormField.vue';
import ZSelect from '../../atoms/ZSelect/ZSelect.vue';
import ZDatePicker from '../../molecules/ZDatePicker/ZDatePicker.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';

export default {
  name: 'ZFiltersEvents',
  components: {
    ZHeading,
    ZList,
    ZForm,
    ZFormField,
    ZSelect,
    ZDatePicker,
    ZLink,
    ZBubble,
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
      selectedCategories: {},
      selectedDate: [],
    };
  },
  computed: {
    taxonomies() {
      return Object.keys(this.categories).reduce((object, taxonomy) => ({ ...object, ...this.categories[taxonomy]?.options.reduce((o, category) => ({ ...o, [category.id]: category }), {}) }), {});
    },
    mappedDate() {
      const after = this.selected && this.$options.filters.format(this.selected.after);
      const before = this.selected && this.$options.filters.format(this.selected.before);

      return [after, before].filter((date) => (date));
    },
    mappedTaxonomies() {
      const exclude = ['after', 'before'];
      return Object.keys(this.selected).reduce((accumulator, option) => {
        const selected = this.selected[option].search(',') > -1 ? this.selected[option].split(',') : [this.selected[option]];

        return exclude.includes(option) ? accumulator : [...accumulator, ...selected];
      }, []);
    },
  },
  watch: {
    // hack to keep data consistency
    selected: {
      handler() {
        this.updateDate(this.selected);
        this.updateCategories(this.selected, this.categories);
      },
      immediate: true,
    },
  },
  methods: {
    selectHandler(category, id) {
      this.selectedCategories[category] = id;
    },
    updateDate(selected) {
      this.selectedDate = [selected.after, selected.before].filter((date) => (date));
    },
    updateCategories(selected, categories) {
      this.selectedCategories = Object.keys(categories).reduce((accumulator, category) => {
        const result = selected[category] && selected[category].search(',') > -1
          ? selected[category].split(',')
          : selected[category];
        if (result) {
          return { ...accumulator, [category]: result };
        }
        return accumulator;
      }, {});
    },
    unselectDate() {
      this.$emit('submit', { after: '', before: '' });
    },
    unselectTaxonomies(option) {
      let query;
      switch (option.taxonomy) {
        default:
          query = {
            [option.taxonomy]: '',
          };
      }
      this.$emit('submit', query);
    },
    submit() {
      const date = { after: this.selectedDate[0] || '', before: this.selectedDate[1] || '' };
      const categories = Object.keys(this.selectedCategories).reduce((object, category) => (
        { ...object, [category]: Array.isArray(this.selectedCategories[category]) ? this.selectedCategories[category].filter((item) => (item !== '0')).join(',') : this.selectedCategories[category] }
      ), {});
      this.$emit('submit', { ...categories, ...date });
    },
    clear() {
      const date = { after: '', before: '' };
      const categories = Object.keys(this.selectedCategories).reduce((object, key) => ({ ...object, [key]: [] }), {});
      this.$emit('submit', { ...categories, ...date });
    },
  },
};
</script>

<style lang="scss">
  .z-filters-events {
    padding: 24px;
    background: #fff;
    border-radius: 10px;
    box-shadow: rgba(157, 157, 157, 0.5) 0 2px 4px 0;

    &__title {
      margin: 0 0 1.5rem 0;
    }

    &__section {
      padding: 0 0 24px 0;
      border: solid #eae5f0;
      border-width: 0 0 2px 0;
      margin: 0 0 24px 0;

      &--no-border {
        padding: 0;
        border-width: 0;
        margin: 0;
      }
    }

    &__section-header {
      display: grid;
      align-items: center;
      justify-content: space-between;
      margin: 0 0 8px 0;
      grid-template-columns: repeat(2, auto);
    }

    &__section-more {
      --link-color: var(--color-primary);
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
