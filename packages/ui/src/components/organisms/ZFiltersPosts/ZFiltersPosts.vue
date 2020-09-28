<template>
  <component
    :is="tag"
    class="z-filters-posts"
  >
    <ZDropdown
      name="Wybierz miesiąc"
      class="z-dropdown--has-chevron z-filters-posts__month"
      @update:open="selectedDate = selectedFilters.date || []"
    >
      <template #default="{toggle}">
        <ZForm
          @submit.prevent="submitDate(toggle)"
          @click:cancel="formCancel(toggle)"
        >
          <template #content>
            <div
              class="z-filters-posts__date-picker"
            >
              <ZDatePicker v-model="selectedDate" />
              <div class="z-filters-posts__date-selected">
                <ZText class="z-filters-posts__date-label">
                  Wybrana data
                </ZText>
                <div v-if="selectedDate.length === 2">
                  <div>{{ selectedDate[0] | format }}</div>
                  <div>-</div>
                  <div>{{ selectedDate[1] | format }}</div>
                </div>
              </div>
            </div>
          </template>
        </ZForm>
      </template>
    </ZDropdown>
    <ZDropdown
      name="Wybierz kategorię"
      class="z-dropdown--has-chevron z-filters-posts__categories"
      @update:open="selectedCategories = selectedFilters.categories || []"
    >
      <template #default="{toggle}">
        <ZForm
          @submit.prevent="submitCategories(toggle)"
          @click:cancel="formCancel(toggle)"
        >
          <template #content>
            <div>
              <template v-for="(category, taxonomy) in categories">
                <ZFormField
                  :key="category.id"
                  :label="category.label"
                >
                  <template #input="{id}">
                    <ZSelect
                      :id="id"
                      :value="categorySelected(taxonomy)"
                      :options="category.options"
                      class="z-field__input"
                      @input="updateCategory($event, taxonomy)"
                    />
                  </template>
                </ZFormField>
              </template>
            </div>
          </template>
        </ZForm>
      </template>
    </ZDropdown>
    <ZDropdown
      name="Wybierz tagi"
      class="z-dropdown--has-chevron z-filters-posts__tags"
      @update:open="selectedTags = selectedFilters.tags || []"
    >
      <template #default="{toggle}">
        <ZForm
          @submit.prevent="submitTags(toggle)"
          @click:cancel="formCancel(toggle)"
        >
          <template #content>
            <ul class="z-filters-posts__tags-list">
              <template v-for="option in tags">
                <li
                  :key="option.id"
                  class="z-filters-posts__tag"
                >
                  <ZBubble
                    :value="isTagSelected(option)"
                    type="filter"
                    style="--button-min-width: 14px; --button-padding: 0;"
                    @input="updateTag($event, option)"
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
    <div class="z-filters-posts__selected">
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
      selectedCategories: [],
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
    isTagSelected(tag) {
      return this.selectedTags ? this.selectedTags.includes(tag.value) : false;
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
    updateTag(isChecked, tag) {
      if (isChecked) {
        this.selectedTags = [...this.selectedTags, tag.value];
      } else {
        this.selectedTags = this.selectedTags.filter((option) => (option !== tag.value));
      }
    },
    submitDate(toggle) {
      toggle();
      this.$emit('submit:date', this.selectedDate);
    },
    submitTags(toggle) {
      toggle();
      this.$emit('submit:tags', this.selectedTags);
    },
    submitCategories(toggle) {
      toggle();
      this.$emit('submit:categories', this.selectedCategories);
    },
    formCancel(toggle) {
      toggle();
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

    &__selected {
      display: flex;
      flex-wrap: wrap;
      justify-content: start;
      margin: 24px 0;
      gap: 8px;
    }

    &__date-picker {
      display: grid;
      align-items: end;
      grid-auto-flow: column;

      .flatpickr-calendar {
        grid-column: 1;
      }
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
