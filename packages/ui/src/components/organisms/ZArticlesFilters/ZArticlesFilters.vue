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
      <form>
        <ZDatePicker v-model="date" />
        <div>
          <ZText>Wybrana data</ZText>
          <div v-if="date.length === 2">
            <div>{{ date[0] | format }}</div>
            <div>-</div>
            <div>{{ date[1] | format }}</div>
          </div>
        </div>
        <div
          style="display: grid;
      max-width: 1120px;
      justify-content: end;
      margin: 32px auto;
      column-gap: 8px;
      grid-auto-flow: column;"
        >
          <ZButton
            style="

                --icon-color: #fff;
                --button-min-width: none;
                --button-padding: 0;
                --button-width: 34px;
                --button-height: 34px;"
            type="button"
          >
            <ZIcon name="cross" />
          </ZButton>
          <ZButton
            style="

                --icon-color: #fff;
                --button-padding: 0;
                --button-min-width: none;
                --button-width: 34px;
                --button-height: 34px;"
          >
            <ZIcon name="approved" />
          </ZButton>
        </div>
      </form>
    </ZDropdown>
    <!-- categories -->
    <ZDropdown
      name="Wybierz kategorię"
      class="z-dropdown--has-chevron z-articles-filters__categories"
    >
      <form>
        <ul>
          <template v-for="category in categories">
            <li :key="category.id">
              {{ category.name }}
            </li>
          </template>
        </ul>
        <div
          style="display: grid;
      max-width: 1120px;
      justify-content: end;
      margin: 32px auto;
      column-gap: 8px;
      grid-auto-flow: column;"
        >
          <ZButton
            style="

                --icon-color: #fff;
                --button-min-width: none;
                --button-padding: 0;
                --button-width: 34px;
                --button-height: 34px;"
            type="button"
          >
            <ZIcon name="cross" />
          </ZButton>
          <ZButton
            style="

                --icon-color: #fff;
                --button-padding: 0;
                --button-min-width: none;
                --button-width: 34px;
                --button-height: 34px;"
          >
            <ZIcon name="approved" />
          </ZButton>
        </div>
      </form>
    </ZDropdown>
    <!-- tags -->
    <ZDropdown
      name="Wybierz tagi"
      class="z-dropdown--has-chevron z-articles-filters__tags"
    >
      <form>
        <ul class="z-articles-filters__tags-list">
          <template v-for="tag in tags">
            <li
              :key="tag.id"
              class="z-articles-filters__tag"
            >
              <ZBubble
                style="--button-min-width: 14px; --button-padding: 0;"
              >
                {{ tag.name }}
              </ZBubble>
            </li>
          </template>
        </ul>
        <div
          style="display: grid;
      max-width: 1120px;
      justify-content: end;
      column-gap: 8px;
      grid-auto-flow: column;"
        >
          <ZButton
            style="

                --icon-color: #fff;
                --button-min-width: none;
                --button-padding: 0;
                --button-width: 34px;
                --button-height: 34px;"
            type="button"
          >
            <ZIcon name="cross" />
          </ZButton>
          <ZButton
            style="

                --icon-color: #fff;
                --button-padding: 0;
                --button-min-width: none;
                --button-width: 34px;
                --button-height: 34px;"
          >
            <ZIcon name="approved" />
          </ZButton>
        </div>
      </form>
    </ZDropdown>
    <div style="display: grid; justify-content: start; margin: 24px 0; gap: 8px; grid-auto-flow: column;">
      <template v-for="(item, index) in ['Zagranica', '13/04/2017 - 18/04/2018', 'Jakaś trzecia kategoria']">
        <ZBubble
          :key="index"
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

export default {
  name: 'ZArticlesFilters',
  components: {
    ZDatePicker,
    ZDropdown,
    ZButton,
    ZIcon,
    ZBubble,
    ZText,
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
      --dropdown-content-width: calc(300% - 37px);
    }

    &__categories {
      --dropdown-toggle-background: #78a22f;
      --dropdown-content-width: calc(200% - 42px);

      margin: 0 0 0 -14px;
    }

    &__tags {
      --dropdown-toggle-background: #4a7b26;
      --dropdown-toggle-color: #fff;

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
