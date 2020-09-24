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
          <ZHeading
            v-if="title"
            :level="3"
            class="z-post__title"
          >
            <ZLink
              :to="to"
              v-text="title"
            />
          </ZHeading>
        </slot>
        <slot name="meta">
          <div class="z-post__meta">
            <slot name="author">
              <ZLink
                v-if="author.name"
                :to="author.href"
                class="z-post__author"
                v-text="author.name"
              />
            </slot>
            <slot name="date">
              <time
                v-if="date"
                :datetime="date"
                class="z-post__date"
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
    border-radius: 10px;
    box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
    grid-template-rows: 128px 1fr;

    &__thumbnail {
      position: relative;
      overflow: hidden;
      line-height: 0;

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

      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }

    &__content {
      display: grid;
      justify-content: space-between;
      padding: 16px 8px;
      grid-template-rows: 1fr auto;
    }

    &__title {
      order: var(--post-title-order);
      margin: 8px 0;
      font-size: 14px;
      font-weight: 400;
    }

    &__meta {
      display: grid;
      align-items: center;
      justify-content: start;
      order: var(--post-meta-order);
      column-gap: 8px;
      grid-template-columns: repeat(2, auto);
    }

    &__author {
      font-size: 10px;
      text-transform: uppercase;
    }

    &__date {
      font-size: 10px;
    }

    &__category {
      --bubble-height: 24px;

      order: -1;
      font-weight: 300;
      place-self: start;
      text-transform: uppercase;
    }

    &--highlighted {
      --bubble-background: #ce171e;

      grid-column: 4;
      grid-row: 2 / span 2;
      grid-template-rows: 1fr 128px;

      #{$this}__content {
        z-index: 1;
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
      --bubble-background: #efac1f;

      grid-column: span 4;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: repeat(2, calc(345px / 2));

      #{$this}__thumbnail {
        grid-column: 1 / span 4;
        grid-row: 1 / span 2;

        &::after {
          content: none;
        }
      }

      #{$this}__content {
        z-index: 1;
        padding: 40px;
        color: #fff;
        grid-column: 1 / span 2;
        grid-row: 2;
        place-self: start;
      }

      #{$this}__title {
        font-size: 24px;
      }
    }
  }
</style>