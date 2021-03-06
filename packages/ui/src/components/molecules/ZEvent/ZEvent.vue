<template>
  <component
    :is="tag"
    class="z-event"
    :style="style"
    :class="{'z-event--expired': isExpired}"
  >
    <slot name="thumbnail">
      <div class="z-event__thumbnail">
        <ZImage
          :src="thumbnail"
          alt=""
        />
      </div>
    </slot>
    <slot name="content">
      <div class="z-event__content">
        <slot name="date">
          <div v-if="isExpired">
            <!-- expired -->
          </div>
          <div
            v-else
            class="z-event__date"
          >
            <ZDate :date="date.begin" />
            <div class="z-date__separator" />
            <ZDate :date="date.end" />
          </div>
        </slot>
        <slot name="heading">
          <ZLink
            :to="to"
            class="z-event__title"
            v-html="title"
          />
        </slot>
        <slot name="excerpt">
          <ZText
            v-if="excerpt"
            class="z-event__excerpt"
            v-html="excerpt"
          />
        </slot>
        <slot name="meta">
          <div
            v-if="audiences.length"
            class="z-event__meta"
          >
            <slot name="audience">
              <template v-for="audience in audiences">
                <ZLink
                  :key="audience.id"
                  tag="span"
                  class="z-event__audience caption"
                >
                  {{ audience.name }}
                </ZLink>
              </template>
            </slot>
          </div>
        </slot>
      </div>
    </slot>
    <slot name="type">
      <ZLink
        v-if="type.name"
        tag="span"
        class="z-event__type"
      >
        <ZBubble class="z-bubble--is-badge">
          {{ type.name }}
        </ZBubble>
      </ZLink>
    </slot>
    <slot name="location">
      <ZLink
        v-if="location.name"
        tag="span"
        class="z-event__location caption"
      >
        <ZBubble class="z-bubble--is-badge">
          {{ location.name }}
        </ZBubble>
      </ZLink>
    </slot>
  </component>
</template>

<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZBubble from '../../atoms/ZBubble/ZBubble.vue';
import ZText from '../../atoms/ZText/ZText.vue';
import ZDate from '../../atoms/ZDate/ZDate.vue';

export default {
  name: 'ZEvent',
  components: {
    ZLink,
    ZImage,
    ZHeading,
    ZBubble,
    ZText,
    ZDate,
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
    date: {
      type: Object,
      default: () => ({
        begin: '',
        end: '',
      }),
    },
    location: {
      type: Object,
      default: () => ({
        name: '',
      }),
    },
    audiences: {
      type: Array,
      default: () => ([]),
    },
    type: {
      type: Object,
      default: () => ({
        name: '',
      }),
    },
    to: {
      type: [Object, String],
      default: () => ({}),
    },
    excerpt: {
      type: String,
      default: '',
    },
  },
  computed: {
    isExpired() {
      const now = Date.now();
      const end = new Date(this.date.end).getTime();
      return (end - now) < 0;
    },
    style() {
      return this.audiences.length === 1 ? {
        '--color': this.audiences[0].rest_acf.color,
        '--background': this.audiences[0].rest_acf.background,
      } : {
        '--color': '#fff',
        '--background': '#748dc7',
      };
    },
  },
};
</script>

<style lang="scss">
  .z-event {
    $this: &;

    position: relative;
    display: grid;
    overflow: hidden;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
    grid-template-rows: 128px 1fr;

    &__thumbnail {
      position: relative;
      overflow: hidden;
      grid-column: 1;
      grid-row: 1;

      & .z-image,
      & img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }

    &__content {
      display: grid;
      justify-content: space-between;
      padding: 32px 8px 16px 8px;
      background: var(--background, #7ba22e);
      color: var(--color, #fff);
      grid-template-rows: 0 1fr auto;
    }

    &__title {
      margin: 0 0 8px 0;

      &::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        content: "";
      }
    }

    &__excerpt {
      margin: 0 0 8px 0;
      font-size: var(--font-size-subtitle-2);

      @media (min-width: 640px) {
        font-size: var(--font-size-body-1);
      }
    }

    &__meta {
      display: grid;
      align-items: center;
      justify-content: start;
      column-gap: 8px;
      grid-template-columns: repeat(2, auto);
    }

    &__audience {
      z-index: 1;
    }

    &__date {
      display: grid;
      align-items: center;
      justify-content: start;
      column-gap: 4px;
      grid-template-columns: repeat(3, auto);
      transform: translateY(-56px);
    }

    &__location,
    &__type {
      --link-color: var(--color, #fff);

      z-index: 1;
      margin: 8px;
      grid-column: 1;
      grid-row: 1;
    }

    &__location {
      place-self: end;
    }

    &__type {
      place-self: start end;
    }

    &--primary {
      grid-template-columns: repeat(12, 1fr);
      grid-template-rows: 1fr;

      #{$this}__thumbnail {
        grid-column: 1 / span 12;

        @media (min-width: 640px) {
          grid-column: 6 / span 7;
          grid-row: 1;
        }
      }

      #{$this}__content {
        grid-column: 1 / span 12;
        grid-template-rows: 0 1fr auto;

        @media (min-width: 640px) {
          align-items: end;
          padding: 32px 40px;
          grid-column: 1 / span 5;
          grid-row: 1;
          grid-template-rows: 1fr auto;
          row-gap: 16px;
        }
      }

      #{$this}__date {
        transform: translateY(-56px);

        @media (min-width: 640px) {
          transform: translateY(0);
        }
      }

      #{$this}__title {
        @media (min-width: 640px) {
          margin: 0;
          font-size: 2.125rem;
        }
      }

      #{$this}__location,
      #{$this}__type {
        grid-column: 12;
      }
    }

    &--expired {
      filter: grayscale(1);
      opacity: 0.5;
    }
  }
</style>
