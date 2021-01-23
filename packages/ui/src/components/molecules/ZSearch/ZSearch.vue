<template>
  <component
    :is="tag"
    class="z-search"
    @submit.prevent="submit"
  >
    <ZInput
      v-model="search"
      v-bind="input"
      type="search"
      class="z-search__input"
      aria-label="wpisz czego szukasz na stornie ZHP"
    />
    <div
      v-if="minChar > 0"
      class="z-search__error"
    >
      <ZText
        v-if="hasError"
        class="caption"
        tag="span"
      >
        Wpisz co najmniej 3 znaki
      </ZText>
    </div>
    <ZButton
      class="z-search__submit"
      aria-label="wyszukaj"
    >
      <ZIcon
        name="search"
        class="z-search__icon"
      />
      <template v-if="hasLabel">
        Wyszukaj
      </template>
    </ZButton>
  </component>
</template>

<script>
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';
import ZInput from '../../atoms/ZInput/ZInput.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'ZSearch',
  components: {
    ZIcon,
    ZInput,
    ZButton,
    ZText,
  },
  props: {
    tag: {
      type: String,
      default: 'form',
    },
    input: {
      type: Object,
      default: () => ({
        placeholder: 'Czego dzisiaj chcesz dowiedzieć się o ZHP?',
      }),
    },
    hasLabel: {
      type: Boolean,
      default: true,
    },
    minChar: {
      type: Number,
      default: 3,
    },
  },
  data() {
    return {
      search: '',
      hasError: false,
    };
  },
  methods: {
    submit() {
      this.hasError = false;
      if (this.search.length >= this.minChar) {
        this.$emit('submit', this.search);
        this.search = '';
      } else {
        this.hasError = true;
      }
    },
  },
};
</script>

<style lang="scss">
.z-search {
  $this: &;
  --input-background: #a6ce39;
  --input-color: #fff;
  --icon-color: #fff;
  --button-min-width: 168px;

  display: grid;
  justify-items: end;

  &__input {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;

    &::-webkit-search-decoration,
    &::-webkit-search-cancel-button,
    &::-webkit-search-results-button,
    &::-webkit-search-results-decoration { display: none; }
  }

  &__icon {
    margin: 0 8px 0 0;
  }

  &__submit {
    --button-border-width: 0;
  }

  &__error {
    display: flex;
    height: 20px;
    align-items: center;
    color: var(--color-primary-darken);
    place-self: center start;
  }

  &--condensed {
    --input-background: #fff;
    --input-color: #1e152f;
    --input-padding: 0 32px 0 8px;
    --input-height: 32px;
    --button-min-width: 32px;
    --button-padding: 0;
    --icon-color: var(--color-primary-darken);
    --button-background: transparent;

    grid-template-columns: 1fr;

    #{$this}__input {
      grid-column: 1;
      grid-row: 1;
    }

    #{$this}__submit {
      grid-column: 1;
      grid-row: 1;
    }

    #{$this}__icon {
      margin: 0;
    }
  }
}
</style>
