<template>
  <component
    :is="tag"
    class="z-post"
  >
    <slot name="thumbnail">
      <div class="z-post__thumbnail">
        <ZImage
          :src="thumbnail"
          alt=""
        />
      </div>
    </slot>
    <slot name="content">
      <div class="z-post__content">
        <slot name="heading">
          <ZLink
            v-if="title"
            :to="to"
            class="z-post__title"
          >
            {{ title }}
          </ZLink>
        </slot>
        <slot name="meta">
          <div class="z-post__meta">
            <slot name="author">
              <ZLink
                v-if="author.name"
                :to="author.href"
                class="z-post__author overline uppercase"
              >
                {{ author.name }}
              </ZLink>
            </slot>
            <slot name="date">
              <time
                v-if="date"
                :datetime="date"
                class="z-post__date overline"
              >{{ date | format }}</time>
            </slot>
          </div>
        </slot>
        <slot name="category">
          <ZBubble
            v-if="category"
            class="z-post__category"
          >
            {{ category }}
          </ZBubble>
        </slot>
      </div>
    </slot>
  </component>
</template>

<script>
import { format } from 'date-fns';
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';

export default {
  name: 'ZPost',
  components: {
    ZImage,
    ZLink,
    ZHeading,
    ZText,
    ZBubble,
  },
  filters: {
    format(date) {
      if (!date) {
        return '';
      }
      return format(new Date(date), 'dd.MM.yyyy');
    },
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    thumbnail: {
      type: [Object, String],
      default: '',
    },
    title: {
      type: String,
      default: '',
    },
    author: {
      type: [Object, String],
      default: () => ({
        name: '',
        href: '',
      }),
    },
    date: {
      type: String,
      default: '',
    },
    to: {
      type: [Object, String],
      default: () => ({}),
    },
    category: {
      type: [String, Array],
      default: '',
    },
  },
  computed: {
    formattedDate() {
      return format(new Date(this.date), 'dd.MM.yyyy');
    },
  },
};
</script>

<style lang="scss">
  .z-post {
    $this: &;

    position: relative;
    display: grid;
    overflow: hidden;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
    grid-template-rows: var(--post-grid-template-rows, 128px 1fr);

    &__thumbnail {
      position: relative;
      overflow: hidden;

      &::after {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #fff;
        content: "";
        transform: translateY(-8px);
      }

      & .z-image,
      & img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }

    &__content {
      display: grid;
      align-items: start;
      justify-content: space-between;
      padding: 16px 8px;
      grid-template-rows: 1fr auto;
    }

    &__title {
      order: var(--post-title-order);
      margin: 8px 0;

      &::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        content: "";
      }
    }

    &__meta {
      display: grid;
      align-items: center;
      justify-content: start;
      order: var(--post-meta-order);
      column-gap: 4px;
      grid-template-columns: repeat(2, auto);
    }

    &__author {
      z-index: 1;

      &::after {
        content: ",";
      }
    }

    &__date {}

    &__category {
      --bubble-height: 24px;

      order: -1;
      place-self: start;
    }

    &--highlighted {
      --bubble-label-background: #ce171e;

      grid-column: 4;
      grid-row: 2 / span 2;
      grid-template-rows: 1fr 128px;

      #{$this}__content {
        z-index: 1;
        align-items: end;
        color: #fff;
        grid-column: 1;
        grid-row: 2;
      }

      #{$this}__thumbnail {
        grid-column: 1;
        grid-row: 1 / span 2;

        &::after {
          content: none;
        }
      }

      #{$this}__category {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(-8px, 8px);
      }
    }

    &--primary {
      --bubble-label-background: #efac1f;
      --bubble-label-color: #fff;

      grid-template-columns: repeat(12, 1fr);
      grid-template-rows: 345px;

      #{$this}__thumbnail {
        grid-column: 1 / span 12;
        grid-row: 1;

        &::after {
          content: none;
        }
      }

      #{$this}__content {
        z-index: 1;
        color: #fff;
        grid-column: 1 / span 12;
        grid-row: 1;
        place-self: end;

        @media (min-width: 640px) {
          padding: 40px;
          grid-column: 1 / span 6;
        }
      }

      #{$this}__title {}
    }
  }
</style>
