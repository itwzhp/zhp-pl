<template>
  <component
    :is="tag"
    class="z-search"
    @submit.prevent="$emit('submit', search)"
  >
    <ZInput
      v-model="search"
      type="text"
      placeholder="Czego dzisiaj chcsz się dowiedzieć o ZHP?"
      class="z-search__input"
    />
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

export default {
  name: 'ZSearch',
  components: {
    ZIcon,
    ZInput,
    ZButton,
  },
  props: {
    tag: {
      type: String,
      default: 'form',
    },
  },
  data() {
    return {
      search: '',
    };
  },
};
</script>

<style lang="scss">
.z-search {
  display: grid;
  grid-row-gap: 16px;
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
}
</style>
