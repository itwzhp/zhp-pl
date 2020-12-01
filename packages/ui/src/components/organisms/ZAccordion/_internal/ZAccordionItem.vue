<template>
  <component
    :is="tag"
    class="z-accordion-item"
  >
    <slot name="title">
      <ZButton
        class="z-button--text z-accordion-item__toggler"
        @click="open"
      >
        <ZIcon
          :name="icon"
          class="z-accordion-item__icon"
        />
        {{ title }}
      </ZButton>
    </slot>
    <div
      v-show="isOpen"
      class="z-accordion-item__content"
    >
      <slot />
    </div>
  </component>
</template>

<script>
import ZButton from '../../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../../atoms/ZIcon/ZIcon.vue';

export default {
  name: 'ZAccordionItem',
  components: { ZButton, ZIcon },
  inject: ['accordion'],
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    title: {
      type: String,
      default: '',
    },

  },
  computed: {
    isOpen() {
      const { opened } = this.accordion;
      return typeof opened === 'string'
        ? opened === this.title
        : opened.includes(this.title);
    },
    icon() {
      return this.isOpen ? 'minus' : 'plus';
    },
  },
  methods: {
    open() {
      const { opened, open } = this.accordion;
      if (typeof opened === 'string') {
        open(
          opened === this.title
            ? ''
            : this.title,
        );
      } else if (opened.includes(this.title)) {
        open(opened.filter((element) => (element !== this.title)));
      } else {
        open([...opened, this.title]);
      }
    },
  },
};
</script>

<style lang="scss">
.z-accordion-item {
  margin: var(--accordion-margin, 4px 0);

  &__toggler {
    --button-min-width: 100%;
    --button-justify-content: flex-start;
    --button-height: auto;

    text-align: left;
  }

  &__icon {
    --icon-size: 0.75rem;
    --icon-color: #7ba22e;

    flex: none;
    margin: var(--accordion-item-icon-margin, 0 0.5rem 0 0);
  }

  &__content {
    padding: 0.5rem 0;
  }
}
</style>
