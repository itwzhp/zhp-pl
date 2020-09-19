<template>
  <component
    :is="tag"
    class="z-event"
    :style="style"
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
          <div class="z-event__date">
            <time
              :datetime="date.begin"
              class="z-calendar"
            >
              <div
                class="z-calendar__day"
                v-text="dateCalendar.begin.day"
              />
              <div
                class="z-calendar__month"
                v-text="dateCalendar.begin.month"
              />
            </time>
            <div class="z-calendar__between" />
            <time
              :datetime="date.end"
              class="z-calendar"
            >
              <div
                class="z-calendar__day"
                v-text="dateCalendar.end.day"
              />
              <div
                class="z-calendar__month"
                v-text="dateCalendar.end.month"
              />
            </time>
          </div>
        </slot>
        <slot name="heading">
          <ZHeading
            class="z-event__title"
            :level="3"
          >
            <ZLink
              :to="to"
              v-text="title"
            />
          </ZHeading>
        </slot>
        <slot name="excerpt">
          <ZText
            v-if="excerpt"
            class="z-event__excerpt"
            v-text="excerpt"
          />
        </slot>
        <slot name="meta">
          <div class="z-event__meta">
            <slot name="location">
              <ZLink to="#">
                <div
                  class="z-event__location"
                  v-text="location.name"
                />
              </ZLink>
            </slot>
            <slot name="audience">
              <ZLink to="#">
                <div
                  class="z-event__audience"
                  v-text="audience.name"
                />
              </ZLink>
            </slot>
          </div>
        </slot>
      </div>
    </slot>
    <slot name="type">
      <ZLink
        :to="type.href"
        class="z-event__type"
      >
        <ZBubble class="z-bubble--is-badge">
          {{ type.name }}
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

export default {
  name: 'ZEvent',
  components: {
    ZLink,
    ZImage,
    ZHeading,
    ZBubble,
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
    audience: {
      type: Object,
      default: () => ({
        name: '',
      }),
    },
    type: {
      type: Object,
      default: () => ({
        name: '',
      }),
    },
    ageGroup: {
      type: Object,
      default: () => ({
        name: '',
        background: '',
        color: '',
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
    style() {
      const { color, background } = this.ageGroup;
      return {
        '--color': color,
        '--background': background,
      };
    },
    dateCalendar() {
      const months = [
        'Sty',
        'Lut',
        'Mar',
        'Kwi',
        'Maj',
        'Cze',
        'Lip',
        'Sie',
        'Wrz',
        'Paź',
        'Lis',
        'Gru'];
      const beginDate = new Date(this.date.begin);
      const endDate = new Date(this.date.end);
      return {
        begin: {
          day: beginDate.getDate().toString().padStart(2, '0'),
          month: months[beginDate.getMonth()],
        },
        end: {
          day: endDate.getDate().toString().padStart(2, '0'),
          month: months[endDate.getMonth()],
        },
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
    border-radius: 10px;
    box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
    grid-template-rows: 128px 1fr;

    &__thumbnail {
      position: relative;
      overflow: hidden;
      line-height: 0;

      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }

    &__content {
      position: relative;
      display: grid;
      justify-content: space-between;
      padding: 32px 8px 16px 8px;
      background: var(--background, #efac1f);
      color: var(--color, #fff);
      grid-template-rows: 1fr auto;
    }

    &__title {
      margin: 0 0 8px 0;
      font-size: 14px;
      font-weight: 400;
    }

    &__excerpt {
      margin: 0 0 8px 0;
    }

    &__meta {
      display: grid;
      align-items: center;
      justify-content: start;
      column-gap: 8px;
      grid-template-columns: repeat(2, auto);
    }

    &__location {
      font-size: 10px;
    }

    &__audience {
      font-size: 10px;
    }

    &__date {
      position: absolute;
      top: 0;
      left: 0;
      display: grid;
      align-items: center;
      justify-content: start;
      margin: 0 0 8px 0;
      column-gap: 4px;
      grid-template-columns: repeat(3, auto);
      transform: translate(8px, -65%);
    }

    &__type {
      --bubble-height: 24px;
      --bubble-background: var(--background);
      --link-text-decoration: none;

      position: absolute;
      top: 0;
      right: 0;
      transform: translate(-8px, 8px);
    }

    &--primary {
      grid-template-columns: repeat(12, 1fr);
      grid-template-rows: 1fr;

      #{$this}__thumbnail {
        grid-column: 6 / span 7;
        grid-row: 1;
      }

      #{$this}__content {
        align-items: end;
        padding: 32px 40px;
        grid-column: 1 / span 5;
        grid-row: 1;
      }

      #{$this}__date {
        position: static;
        transform: unset;
      }

      #{$this}__title {
        font-size: 24px;
      }
    }
  }
  // todo: przenieść do atomu
  .z-calendar {
    display: grid;
    width: 40px;
    height: 48px;
    padding: 4px 0;
    background: #fff;
    border-radius: 5px;
    color: #1e152f;
    grid-template-rows: repeat(2, auto);

    &__day {
      font-size: 14px;
      place-self: center;
    }

    &__month {
      font-size: 10px;
      place-self: center;
    }

    &__between {
      width: 16px;
      height: 4px;
      background: #fff;
      border-radius: 2px;
    }
  }
</style>
