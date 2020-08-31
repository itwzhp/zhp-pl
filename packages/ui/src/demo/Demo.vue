<template>
  <Default>
    <template #default="{component}">
      <component
        :is="component"
      />
    </template>
  </Default>
</template>

<script>
import Default from '../templates/Default/Default.vue';
import Home from '../pages/Home/Home.vue';
import Articles from '../pages/Articles/Articles.vue';
import Events from '../pages/Events/Events.vue';

export default {
  name: 'Demo',
  components: {
    Default,
    Home,
    Articles,
    Events,
  },
};
</script>
