<template>
  <component
    :is="tag"
    class="z-article"
  >
    <slot name="thumbnail">
      <div class="z-article__thumbnail">
        <ZImage
          :src="thumbnail"
          alt=""
        />
      </div>
    </slot>
    <slot name="content">
      <div class="z-article__content">
        <slot name="heading">
          <ZHeading
            class="z-article__title"
            :level="3"
          >
            <ZLink
              :to="to"
              v-text="title"
            />
          </ZHeading>
        </slot>
        <slot name="meta">
          <div class="z-article__meta">
            <slot name="author">
              <ZLink :to="author.href">
                <div
                  class="z-article__author"
                  v-text="author.name"
                />
              </ZLink>
            </slot>
            <slot name="date">
              <time
                :datetime="date"
                class="z-article__date"
                v-text="date"
              />
            </slot>
          </div>
        </slot>
      </div>
    </slot>
  </component>
</template>
<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZText from '../../atoms/ZText/ZText.vue';

export default {
  name: 'ZArticle',
  components: {
    ZImage,
    ZLink,
    ZHeading,
    ZText,
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
  },
};
</script>
<style lang="scss">
  .z-article {
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
      margin: 8px 0;
      font-size: 14px;
      font-weight: 400;
    }

    &__meta {
      display: grid;
      align-items: center;
      justify-content: start;
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

    &--highlighted {
      grid-row: span 2;
      grid-template-rows: 1fr 128px;

      .z-article {
        &__content {
          z-index: 1;
          color: #fff;
          grid-column: 1;
          grid-row: 2;
        }

        &__thumbnail {
          grid-column: 1;
          grid-row: 1 / span 2;

          &::after {
            content: none;
          }
        }
      }
    }

    &--primary {
      grid-column: span 4;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: repeat(2, calc(345px / 2));

      .z-article {
        &__thumbnail {
          grid-column: 1 / span 4;
          grid-row: 1 / span 2;

          &::after {
            content: none;
          }
        }

        &__content {
          z-index: 1;
          padding: 40px;
          color: #fff;
          grid-column: 1 / span 2;
          grid-row: 2;
          place-self: start;
        }

        &__title {
          font-size: 24px;
        }
      }
    }
  }
</style>
