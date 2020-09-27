<template>
  <component
    :is="tag"
    class="z-form"
    v-on="$listeners"
  >
    <slot name="content" />
    <slot name="knobs">
      <div class="z-form__knobs">
        <slot name="cancel">
          <ZButton
            type="button"
            class="z-form__cancel"
            @click="$emit('click:cancel')"
          >
            <ZIcon name="cross" />
          </ZButton>
        </slot>
        <slot name="submit">
          <ZButton class="z-form__submit">
            <ZIcon name="approved" />
          </ZButton>
        </slot>
      </div>
    </slot>
  </component>
</template>

<script>
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';

export default {
  name: 'ZForm',
  components: {
    ZButton,
    ZIcon,
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
  .z-form {
    &__knobs {
      display: grid;
      justify-content: end;
      margin: 16px 0;
      grid-auto-flow: column;
      grid-column-gap: 8px;
    }

    &__cancel,
    &__submit {
      --icon-color: #fff;
      --button-min-width: none;
      --button-width: 34px;
      --button-height: 34px;
      --button-padding: 0;
    }
  }
</style>
