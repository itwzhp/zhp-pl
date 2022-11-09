<template>
  <component
    :is="tag"
    class="z-instagram"
  >
    <div class="z-instagram__heading">
      <ZImage
        :src="image"
        class="z-instagram__picture"
      />
      <div>
        <ZText class="z-instagram__user">
          {{user}}
        </ZText>
        <ZButton
          :to="`https://www.instagram.com/${user}/`"
          class="z-instagram__subscribe"
        >
          Obserwuj
        </ZButton>
      </div>
      <div class="z-instagram__description">
        <ZText class="body-1 z-instagram__name">
          {{ name }}
        </ZText>
        <ZText 
          class="body-2 normal z-instagram__details"
          v-html="description">
        </ZText>
      </div>
    </div>
    <div class="z-instagram__feed">
      <template v-for="(image, key) in feed">
        <ZLink
          :key="key"
          :to="image.href"
        >
          <ZImage :src="render(image.src)" />
        </ZLink>
      </template>
    </div>
  </component>
</template>

<script>
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'ZInstagram',
  components: {
    ZButton,
    ZImage,
    ZLink,
    ZText,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    image: {
      type: String,
      default: '',
    },
    feed: {
      type: Array,
      default: () => ([]),
    },
    name: {
      type: String,
      default: ""
    },
    user: {
      type: String,
      default: ""
    },
    description: {
      type: String,
      default: ""
    }
  },
  methods: {
    render(url) {
      if (typeof document === 'undefined') return;
      const decoder = document.createElement('div');
      decoder.innerHTML = url;
      return decoder.textContent.replace(/"/gm, '');
    },
  },
};
</script>

<style lang="scss">
.z-instagram {
  &__heading {
    display: grid;
    column-gap: 28px;
    grid-template-columns: 77px 1fr;
    row-gap: 24px;
  }

  &__picture {
    overflow: hidden;
    width: 77px;
    height: 77px;
    border-radius: 50%;
  }

  &__subscribe {
    --button-text-transform: none;

    margin: 8px 0 0 0;
  }

  &__user {
    margin: 0;
    font-size: 28px;
  }

  &__name {
    margin: 0;
  }

  &__description {
    margin: 0 0 20px 0;
    grid-column: span 2;
  }

  &__details {
    margin: 0;
  }

  &__feed {
    display: grid;
    gap: 4px;
    grid-template-columns: repeat(3, minmax(auto, 1fr));
  }
}
</style>
