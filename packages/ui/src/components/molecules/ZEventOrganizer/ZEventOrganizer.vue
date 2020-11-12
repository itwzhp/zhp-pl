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
    <ZText v-if="organizer.unit">
      {{ organizer.unit }}
    </ZText>
    <ZText v-if="organizer.person">
      {{ organizer.person }}
    </ZText>
    <ZText v-if="organizer.phone">
      T: <ZLink :to="`tel:${organizer.phone}`">
        {{ organizer.phone }}
      </ZLink>
    </ZText>
    <ZText v-if="organizer.mail">
      @: <ZLink :to="`maito:${organizer.mail}`">
        {{ organizer.mail }}
      </ZLink>
    </ZText>
    <ZText>
      <ZLink :to="web">
        {{ web }}
      </ZLink>
    </ZText>
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
    organizer: {
      type: Object,
      default: () => ({
        unit: '',
        person: '',
        phone: '',
        mail: '',
      }),
    },
    web: {
      type: String,
      default: '',
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
