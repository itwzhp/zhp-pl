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
              :datetime="date.startDate"
              class="z-calendar"
            >
              <div
                class="z-calendar__day"
                v-text="dateCalendar.start.day"
              />
              <div
                class="z-calendar__month"
                v-text="dateCalendar.start.month"
              />
            </time>
            <div class="z-calendar__between" />
            <time
              :datetime="date.startDate"
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
      <ZLink to="#">
        <div
          class="z-event__type"
          v-text="type.name"
        />
      </ZLink>
    </slot>
  </component>
</template>
<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';
import ZHeading from '../../atoms/ZHeading/ZHeading.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';

export default {
  name: 'ZEvent',
  components: {
    ZLink,
    ZImage,
    ZHeading,
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
        start: '',
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
        'Styczeń',
        'Luty',
        'Marzec',
        'Kwiecień',
        'Maj',
        'Cerwiec',
        'Lipiec',
        'Sierpień',
        'Wrzesień',
        'Październik',
        'Listopad',
        'Grudzień'];
      const start = this.date.start.split('/'); // todo: ustawić w ACF tak żeby można było użyć new Date()
      const end = this.date.end.split('/'); // todo: ustawić w ACF tak żeby można było użyć new Date()
      return {
        start: {
          day: start[0],
          month: months[parseInt(start[1], 10) - 1],
        },
        end: {
          day: end[0],
          month: months[parseInt(end[1], 10) - 1],
        },
      };
    },
  },
};
</script>
<style lang="scss">
  .z-event {
    position: relative;
    display: grid;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
    grid-template-rows: 1fr 128px;

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
      column-gap: 4px;
      grid-template-columns: repeat(3, auto);
      place-self: start;
      transform: translate(8px, -65%);
    }

    &__type {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 72px;
      padding: 4px 8px;
      background: var(--background);
      border-radius: 10px;
      color: var(--color, #fff);
      text-align: center;
      transform: translate(-8px, 8px);
    }

    &--primary {}
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
