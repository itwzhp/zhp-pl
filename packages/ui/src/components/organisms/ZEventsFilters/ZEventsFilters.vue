<template>
  <component
    :is="tag"
    class="z-events-filters"
    style=" padding: 24px;
        border-radius: 10px;
        box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
        grid-row: span 3;
        place-self: start"
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
    <div class="z-events-filters__section">
      <div class="z-field">
        <ZText
          tag="label"
          for="eventTypes"
          class="z-field__label"
        >
          Rodzaj wydarzenia
        </ZText>
        <ZSelect
          id="eventTypes"
          class="z-field__input"
          :options="[{name:'Obóz'}, {name:'Zlot'}, {name:'Konerencja'}]"
        />
      </div>
      <div class="z-field">
        <ZText
          tag="label"
          for="ageGroups"
          class="z-field__label"
        >
          Metodyka
        </ZText>
        <ZSelect
          id="ageGroups"
          :options="[{name:'Zuchy'}, {name:'Harcerze'}, {name:'Harcerze Stars'}, {name:'Wędrownicy'}]"
          class="z-field__input"
        />
      </div>
      <div class="z-field">
        <ZText
          tag="label"
          for="districts"
          class="z-field__label"
        >
          Metodyka
        </ZText>
        <ZSelect
          id="districts"
          :options="[{name:'Opolskie'}, {name:'Dolnośląskie'}, {name: 'Śląskie'}]"
          class="z-field__input"
        />
      </div>
      <div class="z-field">
        <ZText
          tag="label"
          for="districts"
          class="z-field__label"
        >
          Data Wydarzenia
        </ZText>
        <div id="date" class="z-field__input">
          range data picker
        </div>
      </div>
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
      <ZInput />
    </div>
    <div
      class="z-form-actions"
    >
      <ZButton type="button">
        <ZIcon name="cross" />
      </ZButton>
      <ZButton>
        <ZIcon name="approved" />
      </ZButton>
    </div>
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

export default {
  name: 'ZEventsFilters',
  components: {
    ZLink,
    ZButton,
    ZBubble,
    ZIcon,
    ZText,
    ZHeading,
    ZSelect,
    ZInput,
  },
  props: {
    tag: {
      type: String,
      default: 'form',
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

  .z-field {
    margin: 0 0 16px 0;

    &:last-child {
      margin: 0;
    }

    &__label {
      display: block;
      margin: 0 0 8px 0;
      color: #78a22f;
      text-transform: uppercase;
    }

    &__input {
      width: var(--input-width, 100%);
      height: var(--input-height, 48px);
      padding: var(--input-padding, 0 16px);
      border: var(--input-border, 1px solid #a6ce39);
      background: var(--input-background);
      border-radius: var(--input-border-radius, 10px);
      color: var(--input-color, #fff);

      &::placeholder {
        color: var(--input-color, #fff);
      }
    }
  }

  .z-form-actions {
    --icon-color: #fff;
    --button-width: 34px;
    --button-height: 34px;

    display: grid;
    justify-content: end;
    margin: 16px 0;
    column-gap: 8px;
    grid-auto-flow: column;
  }
</style>
