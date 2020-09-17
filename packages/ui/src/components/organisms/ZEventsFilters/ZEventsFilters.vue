<template>
  <component
    :is="tag"
    class="z-events-filters"
    style=" padding: 24px;
        border-radius: 10px;
        box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
        grid-row: span 3;
        place-self: start;"
  >
    <ZHeading
      :level="3"
      class="z-events-filters__title"
    >
      Filtry
    </ZHeading>
    <div class="z-events-filters__section">
      <div class="z-events-filters__section-header">
        <ZHeading
          :level="4"
          class="z-events-filters__section-header-title"
        >
          Aktywne filtry
        </ZHeading>
      </div>
      <ul style="display: flex; flex-wrap: wrap; padding: 0; margin: -3px; list-style-type: none;">
        <template v-for="(item, index) in ['Zagranica', '13/04/2017 - 18/04/2017', 'Jakaś trzecia kategoria']">
          <li
            :key="index"
            style="margin: 3px;"
          >
            <ZBubble
              type="filter"
            >
              {{ item }}
            </ZBubble>
          </li>
        </template>
      </ul>
    </div>
    <ZForm @submit.prevent="submit">
      <template #content>
        <div class="z-events-filters__section">
          <ZFormField label="Rodzaj wydarzenia">
            <template #input>
              <ZSelect
                id="eventTypes"
                class="z-field__input"
                :options="[{name:'Obóz'}, {name:'Zlot'}, {name:'Konerencja'}]"
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
          <ZFormField label="Województwo">
            <template #input>
              <ZSelect
                id="districts"
                :options="[{name:'Opolskie'}, {name:'Dolnośląskie'}, {name: 'Śląskie'}]"
                class="z-field__input"
              />
            </template>
          </ZFormField>
          <ZFormField label="Data Wydarzenia">
            <template #input>
<!--              <ZDatePicker />-->
            </template>
          </ZFormField>
        </div>
        <div class="z-events-filters__section z-events-filters__section--no-border">
          <div class="z-events-filters__section-header">
            <ZHeading
              :level="4"
              class="z-events-filters__section-header-title"
            >
              Tagi
            </ZHeading>
            <ZLink
              to="#"
              class="z-events-filters__section-header-more"
            >
              Zobacz wszystkie
            </ZLink>
          </div>
          <ZFormField/>
        </div>
      </template>
    </ZForm>
  </component>
</template>

<script>
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
  name: 'ZEventsFilters',
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
  props: {
    tag: {
      type: String,
      default: 'form',
    },
  },
  methods: {
    submit() {
      return true;
    },
  },
};
</script>

<style lang="scss">
  .z-events-filters {
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
          font-weight: 500;
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
  }
</style>
