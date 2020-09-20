<template>
  <component
    :is="tag"
    class="z-articles-filters"
  >
    <!-- date -->
    <ZDropdown
      name="Wybierz miesiąc"
      class="z-dropdown--has-chevron z-articles-filters__month"
    >
      <ZForm>
        <template #content>
          <div style="display: grid; grid-auto-flow: column;">
            <ZDatePicker v-model="date" />
            <div>
              <ZText>Wybrana data</ZText>
              <div v-if="date.length === 2">
                <div>{{ date[0] | format }}</div>
                <div>-</div>
                <div>{{ date[1] | format }}</div>
              </div>
            </div>
          </div>
        </template>
      </ZForm>
    </ZDropdown>
    <!-- categories -->
    <ZDropdown
      name="Wybierz kategorię"
      class="z-dropdown--has-chevron z-articles-filters__categories"
    >
      <ZForm>
        <template #content>
          <div class="z-articles-filters__form-categories">
            <ZFormField label="Zespół">
              <template #input>
                <ZSelect
                  id="teams"
                  :options="[{name:'Wydział zagraniczny'}, {name:'Harcerski instytut badawczy'}]"
                  class="z-field__input"
                />
              </template>
            </ZFormField>
            <ZFormField label="Metodyka">
              <template #input>
                <ZSelect
                  id="ageGroups"
                  :options="[{name:'Zuchy'}, {name:'Harcerze'}, {name:'Harcerze Stars'}, {name:'Wędrownicy'}]"
                  class="z-field__input"
                />
              </template>
            </ZFormField>
            <ZFormField label="Jakaś trzecia kategoria">
              <template #input>
                <ZSelect
                  id="thirdOption"
                  :options="[{name:'opcja A'}, {name:'opcja B'}, {name:'opcja C'}, {name:'opcja D'}]"
                  class="z-field__input"
                />
              </template>
            </ZFormField>
          </div>
        </template>
      </ZForm>
    </ZDropdown>
    <!-- tags -->
    <ZDropdown
      name="Wybierz tagi"
      class="z-dropdown--has-chevron z-articles-filters__tags"
    >
      <ZForm>
        <template #content>
          <ul class="z-articles-filters__tags-list">
            <template v-for="tag in tags">
              <li
                :key="tag.id"
                class="z-articles-filters__tag"
              >
                <ZBubble
                  type="filter"
                  style="--button-min-width: 14px; --button-padding: 0;"
                >
                  {{ tag.name }}
                </ZBubble>
              </li>
            </template>
          </ul>
        </template>
      </ZForm>
    </ZDropdown>
    <div style="display: grid; justify-content: start; margin: 24px 0; gap: 8px; grid-auto-flow: column;">
      <template v-for="(item, index) in ['Zagranica', '13/04/2017 - 18/04/2018', 'Jakaś trzecia kategoria']">
        <ZBubble
          :key="index"
          :value="true"
          type="filter"
        >
          {{ item }}
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
  name: 'ZArticlesFilters',
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
  },
  data() {
    return {
      date: [],
    };
  },
};
</script>

<style lang="scss">
  .z-articles-filters {
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
  }
</style>
