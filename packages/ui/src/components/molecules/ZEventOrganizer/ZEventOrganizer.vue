<template>
  <component
    :is="tag"
    class="z-event-organizer"
  >
    <ZHeading
      :level="3"
      class="t6 uppercase"
    >
      Organizator:
    </ZHeading>
    <ZText>Główna Kwatera ZHP</ZText>
    <ZText>Jan Kowalski</ZText>
    <ZText>
      T: <ZLink to="tel:+48 221 231 214">
        +48 221 231 214
      </ZLink>
    </ZText>
    <ZText>
      @: <ZLink to="maito: jan.kowalski@gmail.com">
        jan.kowalski@gmail.com
      </ZLink>
    </ZText>
    <ZText>
      <ZLink to="www.ej2020.zhp.pl">
        www.ej2020.zhp.pl
      </ZLink>
    </ZText>
    <ZButton>Skontaktuj się</ZButton>
  </component>
</template>

<script>
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';

export default {
  name: 'ZEventOrganizer',
  components: {
    ZHeading,
    ZText,
    ZLink,
    ZButton,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
  },
};
</script>

<style lang="scss">
.z-event-organizer {
  padding: 1.25rem;
  background: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0 10px 30px 0 rgba(209, 213, 223, 0.5);
}
</style>
