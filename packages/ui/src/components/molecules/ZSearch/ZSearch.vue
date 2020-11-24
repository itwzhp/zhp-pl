<template>
  <component
    :is="tag"
    class="z-search"
    @submit.prevent="submit"
  >
    <ZInput
      v-model="search"
      v-bind="input"
      type="text"
      placeholder="Czego dzisiaj chcesz dowiedzieć się o ZHP?"
      class="z-search__input"
      aria-label="wpisz czego szukasz na stornie ZHP"
    />
    <div class="z-search__error">
      <ZText
        v-if="hasError"
        class="caption"
        tag="span"
      >
        Wpisz proszę conajmniej 3 znaki
      </ZText>
    </div>
    <ZButton
      style="--button-min-width: 168px;"
      class="z-search__submit"
    >
      <ZIcon
        name="search"
        class="z-search__icon"
      />
      Wyszukaj
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
      default: () => ({}),
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
      if (this.search.length >= 3) {
        this.$emit('submit', this.search);
      } else {
        this.hasError = true;
      }
    },
  },
};
</script>

<style lang="scss">
.z-search {
  display: grid;
  justify-items: end;

  &__input {
    --input-background: #a6ce39;
    --input-color: #fff;

    width: 100%;
  }

  &__icon {
    --icon-color: #fff;

    margin: 0 8px 0 0;
  }

  &__submit {
    --button-border-width: 0;
  }
  &__error {
    color: var(--color-primary-darken);

    display: flex;
    align-items: center;
    place-self: center start;
    height: 20px;
  }
}
</style>
