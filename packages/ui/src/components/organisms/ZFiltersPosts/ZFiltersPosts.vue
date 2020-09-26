<template>
  <component
    :is="tag"
    class="z-filters-posts"
  >
    <!-- date -->
    <ZDropdown
      name="Wybierz miesiąc"
      class="z-dropdown--has-chevron z-filters-posts__month"
    >
      <ZForm>
        <template #content>
          <div style="display: grid; align-items: end; grid-auto-flow: column;">
            <ZDatePicker v-model="dateRange" />
            <div class="z-filters-posts__date  -selected">
              <ZText class="z-filters-posts__date-label">
                Wybrana data
              </ZText>
              <div v-if="dateRange.length === 2">
                <div>{{ dateRange[0] | format }}</div>
                <div>-</div>
                <div>{{ dateRange[1] | format }}</div>
              </div>
            </div>
          </div>
        </template>
      </ZForm>
    </ZDropdown>
    <!-- categories -->
    <ZDropdown
      name="Wybierz kategorię"
      class="z-dropdown--has-chevron z-filters-posts__categories"
    >
      <ZForm>
        <template #content>
          <div class="z-filters-posts__form-categories">
            <template v-for="category in categories">
              <ZFormField
                :key="category.id"
                :label="category.label"
              >
                <template #input="{id}">
                  <ZSelect
                    :id="id"
                    :value="selectedCategories[category.id]"
                    :options="category.options"
                    class="z-field__input"
                    @input="selectedCategories[category.id] = $event"
                  />
                </template>
              </ZFormField>
            </template>
          </div>
        </template>
      </ZForm>
    </ZDropdown>
    <!-- tags -->
    <ZDropdown
      name="Wybierz tagi"
      class="z-dropdown--has-chevron z-filters-posts__tags"
    >
      <ZForm @submit.prevent="submitSelectedTags">
        <template #content>
          <ul class="z-filters-posts__tags-list">
            <template v-for="tag in tags">
              <li
                :key="tag.id"
                class="z-filters-posts__tag"
              >
                <ZBubble
                  :value="isTagSelected(tag.value)"
                  type="filter"
                  style="--button-min-width: 14px; --button-padding: 0;"
                  @input="updateCheckedTags($event, tag)"
                >
                  {{ tag.label }}
                </ZBubble>
              </li>
            </template>
          </ul>
        </template>
      </ZForm>
    </ZDropdown>
    <div class="z-filters-posts__enabled">
      <template v-for="(filter, index) in selectedFiltersRendered">
        <ZBubble
          :key="index"
          :value="true"
          type="filter"
        >
          {{ filter.label }}
        </ZBubble>
      </template>
    </div>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZDatePicker from '../../atoms/ZDatePicker/ZDatePicker.vue';
import ZDropdown from '../../molecules/ZDropdown/ZDropdown.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZForm from '../ZForm/ZForm.vue';
import ZFormField from '../../molecules/ZFormField/ZFormField.vue';
import ZSelect from '../../atoms/ZSelect/ZSelect.vue';

export default {
  name: 'ZFiltersPosts',
  components: {
    ZDatePicker,
    ZDropdown,
    ZButton,
    ZIcon,
    ZBubble,
    ZText,
    ZForm,
    ZFormField,
    ZSelect,
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
      type: Array,
      default: () => ([]),
    },
    tags: {
      type: Array,
      default: () => ([]),
    },
    selectedFilters: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      selectedCategories: { teams: 'instytut-badawczy' },
      selectedTags: {},
      dateRange: ['2020-09-01', '2020-09-24'],
    };
  },
  computed: {
    selectedFiltersRendered() {
      return Object.keys(this.selectedFilters).reduce((accumulator, filters) => ({
        ...accumulator,
        ...this.selectedFilters[filters],
      }), {});
    },
  },
  methods: {
    isTagSelected(value) {
      return !!this.selectedTags[value];
    },
    updateCheckedTags(checked, tag) {
      if (checked) {
        this.selectedTags = { ...this.selectedTags, [tag.id]: tag };
      } else {
        this.selectedTags = Object.keys(this.selectedTags).reduce((accumulator, id) => (id === `${tag.id}`
          ? accumulator : {
            ...accumulator,
            [id]: this.selectedTags[id],
          }), {});
      }
    },
    submitSelectedTags() {
      this.$emit('submit:tags', this.selectedTags);
    },
  },
};
</script>

<style lang="scss">
  .z-filters-posts {
    --button-height: 40px;
    --button-padding: 8px 32px;
    --button-min-width: 160px;
    --button-box-shadow: 5px 10px 20px 0 rgba(0, 0, 0, 0.13);

    &__month {
      --dropdown-content-width: calc(300% - 5px);
    }

    &__categories {
      --button-background: #78a22f;
      --dropdown-content-width: calc(200% - 10px);

      margin: 0 0 0 -14px;
    }

    &__form-categories {
      padding: 0 32px;
    }

    &__tags {
      --button-min-width: 192px;
      --button-background: #4a7b26;
      --button-color: #fff;

      margin: 0 0 0 -14px;
    }

    &__tags-list {
      --bubble-min-width: none;

      display: flex;
      flex-wrap: wrap;
      padding: 0;
      margin: -3px -3px 10px -3px;
      gap: 0;
      grid-template-columns: repeat(auto-fill, minmax(auto, 1fr));
      list-style-type: none;
    }

    &__tag {
      margin: 3px;
    }

    &__enabled {
      display: grid;
      justify-content: start;
      margin: 24px 0;
      gap: 8px;
      grid-auto-flow: column;
    }

    &__date-selected {
      padding: 16px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.05);
      line-height: 1.4;
      text-align: center;
    }

    &__date-label {
      margin: 0 0 8px 0;
      font-weight: 900;
      text-transform: uppercase;
    }
  }
</style>
